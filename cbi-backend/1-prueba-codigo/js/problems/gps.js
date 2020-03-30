/*
	¡El GPS se ha roto y tenemos que llegar a un sitio!

	Por suerte, tienes un mapa y tu algoritmo sigue intacto. Eso sí, tu mapa es
	un poco	extraño: todas las intersecciones están etiquetadas con números enteros
	diferentes y las  carreteras que las conectan están etiquetadas con el tiempo
	que se tarda en recorrerlas expresado en minutos.

	Te encuentras en la intersección etiquetada como "start" y tu destino es la
	interescción etiquetada como "finish".

	Dispondrás del número total de intersecciones y un array de carreteras, cada
	una de ellas con las propiedades: "from", "to" (las interesecciones están
	etiquetadas con números enteros menores que el número de intersecciones) y
	"drivingTime". Las carreteras sólo pueden ser usadas para ir desde "from" a
	"to". No hay carreteras de doble sentido.

	Completa la función para que devuelva un array de intersecciones de la ruta
	más rápida desde "start" hasta "finish" (ambas incluidas).

	Si hay vairas rutas iguales, coge cualquiera. Si no hay rutas, devuelve null.

	Ejemplo:

	var roads = [
	    {from: 0, to: 1, drivingTime: 5},
	    {from: 0, to: 2, drivingTime: 10},
	    {from: 1, to: 2, drivingTime: 10},
	    {from: 1, to: 3, drivingTime: 2},
	    {from: 2, to: 3, drivingTime: 2},
	    {from: 2, to: 4, drivingTime: 5},
	    {from: 3, to: 2, drivingTime: 2},
	    {from: 3, to: 4, drivingTime: 10}
	];
	navigate(5, roads, 0, 4);
	// devolvería [0, 1, 3, 2, 4]. Tiempo más rápido is 5 + 2 + 2 + 5 = 14 minutes

*/

const roads = [
	{from: 0, to: 1, drivingTime: 5},
	{from: 0, to: 2, drivingTime: 10},
	{from: 1, to: 2, drivingTime: 10},
	{from: 1, to: 3, drivingTime: 2},
	{from: 2, to: 3, drivingTime: 2},
	{from: 2, to: 4, drivingTime: 5},
	{from: 3, to: 2, drivingTime: 2},
	{from: 3, to: 4, drivingTime: 10}
];

const _get_rawmatrix = (roads) => roads.map(obj => [obj.from,obj.to])

const _in_array = (ar1,ar2) => {
  const ilen = ar2.filter( (vertix,i,arx) => (vertix[0]==ar1[0] && vertix[1] == ar1[1])).length
  //console.log(ar1,ar2,ilen)
  return ilen>0
}

const _get_loops = (raw)=>{
  const loops = raw.filter( vertix =>{
    return _in_array(vertix,raw) && _in_array([vertix[1],vertix[0]],raw)
  })
  return loops
}

//const raw = _get_rawmatrix(roads)
//console.log("raw",raw)

const _get_nodes = (ifrom,raw) => raw.filter(row => row[0]==ifrom).sort()

const _get_ends = (nodes) => nodes.map(ar => ar[1]).sort()

const _ar_copy = (org,dest) => {
  org.forEach(ar => {
    if(! dest.includes(ar))
      dest.push(ar)
  })
}

const _has_destiny = (vertix,dest) => vertix[1] == dest

const _get_count = (vertix,rows) =>{
  const count = rows.reduce((ac,item)=>{
    if(item[0] == vertix[0] && item[1] == vertix[1])
      return ac + 1
    return ac + 0
  },0)
  return count
}

const _get_arlevel = (arxprev,raw,to,visited,loops)=>{
  const ends = [...new Set(_get_ends(arxprev).filter(iend => iend<to))]
  //console.log("endsx")
  //console.table(ends)
  
  const arlevel = []
  ends.forEach((xnode)=>{
    const artmp = _get_nodes(xnode,raw)
    artmp.forEach(vertix => {
      const ivis = _get_count(vertix, visited)
      //console.log(vertix,ivis)
      if(!_in_array(vertix,visited) || 
        (_in_array(vertix,visited) && _has_destiny(vertix,to)) 
        || (_in_array(vertix,visited) && _in_array(vertix,loops) && ivis<2)){
        if(vertix[1]<=to)
          arlevel.push(vertix)
        visited.push(vertix)
      }
    })
  })

  return arlevel
}

const _get_leftjoined = (ar1,ar2)=>{
  const join = []
  if(ar2.length==0) return ar1

  const _in_col0 = (val,ar2)=>{
    const ilen = ar2.filter(row => row[0]==val).length
    return ilen>0
  }

  ar1.forEach((row1,i)=>{
    const ilen = row1.length-1
    const ilast = row1[ilen]

    if(_in_col0(ilast,ar2)){
      ar2.forEach((row2,j)=>{
        if(ilast == row2[0]){
          const tmprow = []
          row1.forEach((v1)=>{
            tmprow.push(v1)
          })
          row2.forEach(v2 => {
            //if(!tmprow.includes(v2))
            tmprow.push(v2)
          })
          join.push(tmprow)
        }
      })//foreach ar2
    }
    //si no tiene pareja
    else{
      const tmprow = []
      row1.forEach((v1)=>{
        tmprow.push(v1)
      })
      tmprow.push(-1)
      tmprow.push(-1)
      join.push(tmprow)
    }
    
  })//foreach ar1
  return join
}

const _has_capicua = (row)=>{
  //console.log(row)
  for(let i=0; i<row.length-2; i=i+2){
    let ip1 = i+1
    let ip2 = i+2
    let ip3 = i+3
    //console.log(i,ip1,ip2,ip3)
    if(row[i]==row[ip3] && row[ip1]==row[ip2] && row[i]!=-1) 
      return true
  }
  return false
}

const _is_node = (inode,raw)=>{
  const ilen = raw.filter(row => row[0]==inode || row[1]==inode).length
  return ilen>0
}

const _get_time = (from,to,roads)=>{
  const time = roads.filter(obj => obj.from == from && obj.to ==to)
  if(time.length>0)
    return time[0].drivingTime
  return 0
}

const _get_obj_time = (paths, roads)=>{
  //console.table(roads)
  //return
  const unique = []
  paths.forEach(row => {
    const tmprow = []
    row.forEach(val => {
      if(!tmprow.includes(val) && val!=-1)
        tmprow.push(val)
    })
    unique.push(tmprow)
  })

  //console.table(unique)
  //return
  const times = []
  unique.forEach(row => {
    
    const values = []
    row.forEach((nodex,i) => {
      values.push(_get_time(nodex,row[i+1] || -1,roads))      
    })
    const sum = values.reduce((ac,time)=> ac+time)
    values.push(sum)
    times.push(values.filter(time => time!=0))
  })

  return {
      nodes: unique,
      times
    }
}

const _get_min_route = (obj)=>{
  const mins = []
  obj.times.forEach(row => {
    mins.push(row[row.length-1])
  })
  const imin = mins.indexOf(Math.min(...mins))
  return {
    i:imin,
    time:mins[imin]
  }
}

const _get_merged_levels = (arlevels)=>{
  let armerged = arlevels[0]
  for(let i=1; i<arlevels.length; i++){
    armerged = _get_leftjoined(armerged, arlevels[i])
  }
  return armerged
}

//================================
//================================
const _get_paths = (roads,from=0,to=4) => {
  //const from = 2
  //const to = 4
  const visited = []
  
  const raw = _get_rawmatrix(roads)
  if(!(_is_node(from,raw) && _is_node(to,raw)))
    return []

  const loops = _get_loops(raw)

  const arlevels = []
  arlevels.push(_get_nodes(from, raw))
  _ar_copy(arlevels[0], visited)
  
  for(let i=0; i<5; i++){
    const arlevi = arlevels[i] || []
    if(arlevi.length==0)
      break
    const artmp = _get_arlevel(arlevi,raw,to,visited,loops)
    if(artmp.length>0)
      arlevels[i+1] = artmp
  }

  //console.log(arlevels)
  const armerged = _get_merged_levels(arlevels)
  //console.table(armerged)
  //quito las rutas con loops
  const noloops = armerged.filter(row => !_has_capicua(row))
  //me quedo con las rutas que tienen el destino "to"
  const onlyend = noloops.filter(row => {
    const arpath = row.filter(val => val!=-1)
    return arpath[arpath.length-1] == to
  })

  //console.log("onlyend")
  //console.table(onlyend)
  return onlyend

}// _get_paths

const _get_msg = (objtime) => {
  //console.log(objtime)
  const ipath = objtime.minroute.i
  const sum = objtime.times[ipath].pop()
  const msg = `[${objtime.nodes[ipath].join(", ")}]. Tiempo más rápido is ${objtime.times[ipath].join(" + ")} = ${sum} minutes`
  return msg
}


//navigate(5, roads, 0, 4);
export default function navigate(numberOfIntersections, roads, start, finish) {
//function navigate(numberOfIntersections, roads, start, finish) {
  //console.log("start:",start,"finish:",finish,"numberOfIntersections:",numberOfIntersections)
  const allpaths = _get_paths(roads,start,finish)
  //console.log("allpaths")
  //console.table(allpaths)

  const onlyinodes = allpaths.filter(row => {
    const ilen = (row.filter(xnode => xnode!=-1).length/2)+1
    //console.log("num nodes found:",ilen)
    return ilen==numberOfIntersections
  })

  if(onlyinodes.length==0)
    return null

  //console.log("onlyinodes")
  //console.table(onlyinodes)

  const objtime = _get_obj_time(onlyinodes,roads)
  objtime.minroute = _get_min_route(objtime)
  //console.log(objtime)
  const msg = _get_msg(objtime)
  //console.log("msg",msg)
  return msg
}

// console.log(navigate(0,roads,0,0))