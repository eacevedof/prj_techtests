/*
  	Dado un array nxn, devuelve los elementos ordenados de fuera hacia dentro
	en espiral en el sentido de las agujas del reloj.

	Ejemplo:
	array = [[1,2,3],
             [4,5,6],
             [7,8,9]]
	snail(array) #=> [1,2,3,6,9,8,7,4,5]

	Nota: El objetivo NO es ordenar los elementos de menor a mayor, sino recorrer
	la matriz en espiral.
	Nota: La matriz 0x0 se representa como [[]]
*/

const thearray = [
  [1,2,3,"a"],
  [4,5,6,"b"],
  [7,8,9,"c"],
  [11,15,22,"x"],                
]

const _get_rings = array => Math.ceil(array.length/2)

const _get_row = (array,y, xmin, xmax) => array[y].filter((val,x) => (x>=xmin && x<=xmax))

const _get_col = (array,x, ymin, ymax) => array.map((row,y)=>(y>=ymin && y<=ymax) ? row[x] : null).filter(val => val!=null)

export default function snail(array){
//function snail(array){

  let snail = []
  
  const n1plus = array[0].length
  
  if(n1plus){
    const idim = array.length
    const n = idim - 1
    const irings = _get_rings(array)

    //console.log("array",array,"rings",irings)
    for(let ring=0; ring<irings; ring++){
        //console.log("ring:",ring)
        const row1 = _get_row(array,ring,ring,n-ring)
        snail = snail.concat(row1)
        //console.log("row1",row1)
        const x = n-ring;  const ymin = ring+1; const ymax = n-ring;
        const col1 = _get_col(array,x,ymin,ymax)
        snail = snail.concat(col1)
        //console.log("col",col1)
        //const row2 = _get_row(array,n-ring,ring,n-ring-1).reverse()
        const row2 = _get_row(array,x,ring,ymax-1).reverse()
        snail = snail.concat(row2)
        //console.log("row2",row2)
        const col2 = _get_col(array,ring,ring+1,ymax-1).reverse()
        snail = snail.concat(col2)
        //console.log("col2",col2)
    }
    
  }//if(dim>0)

  //console.log("snail",snail)
  return snail
}//snail

//snail(thearray)