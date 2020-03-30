
//npm run test | npma test
//console.log("prueba.js")
import snail from "../problems/caracol"
import navigate from "../problems/gps"
//console.log(snail)

const _are_equal = (ar1,ar2) => {
  if(ar1.length!=ar2.length) 
    return false
  
  ar1.forEach((val1,i)=>{
    const val2 = ar2[i]
    if(val1!==val2)
      return false
  })
  return true
}

describe('caracol', function() {

  const snails = [
    {n0x0:[[]],expected:[]},
    {n1x1:[[5]],expected:[5]},
    {n2x2:[[5,9],[3,7]],expected:[5,9,3,7]},
    {n3x3:[[5,9,1],[3,7,4],[11,33,49]],expected:[5,9,1,4,49,33,11,4,7]},
    {n4x4:[[5,9,1,6],[3,7,4,5],[11,33,49,8],[8,7,6,5]],expected:[5,9,1,6,5,8,5,6,7,8,11,3,7,4,49,33]},
  ]
  
  const _get_to_test = dimid => snails.filter(obj => obj[dimid]!=undefined)[0][dimid]
  const _get_expected = dimid => snails.filter(obj => obj[dimid]!=undefined)[0]["expected"]

  it('caracol n x n | n=0', function() {
    const arnxn = _get_to_test("n0x0")
    //console.log(arnxn)
    const expected = _get_expected("n0x0")
    const snailed = snail(arnxn)

    const equal = _are_equal(snailed,expected)
		expect(true).toBe(equal);
  });
  
  it('caracol n x n | n=1', function() {
    const arnxn = _get_to_test("n1x1")
    const expected = _get_expected("n1x1")
    const snailed = snail(arnxn)

    const equal = _are_equal(snailed,expected)
		expect(true).toBe(equal);
	});

  it('caracol n x n | n=2', function() {
    const arnxn = _get_to_test("n2x2")
    const expected = _get_expected("n2x2")
    const snailed = snail(arnxn)

    const equal = _are_equal(snailed,expected)
		expect(true).toBe(equal);
	});

  it('caracol n x n | n=3', function() {
    const arnxn = _get_to_test("n3x3")
    const expected = _get_expected("n3x3")
    const snailed = snail(arnxn)

    const equal = _are_equal(snailed,expected)
		expect(true).toBe(equal);
	});  

  it('caracol n x n | n=4', function() {
    const arnxn = _get_to_test("n4x4")
    const expected = _get_expected("n4x4")
    const snailed = snail(arnxn)

    const equal = _are_equal(snailed,expected)
		expect(true).toBe(equal);
	});  

});

describe("gps", function(){
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

  //console.log(navigate(5,roads,0,4))
  const objtests = {
    t0:{
      intersections:0,start:0,finish:0,
      expected: null
    },
    t1:{
      intersections:1,start:0,finish:0,
      expected: null
    },
    t2:{
      intersections:0,start:0,finish:1,
      expected: null
    },
    t3:{
      intersections:2,start:0,finish:1,
      expected: "[0, 1]. Tiempo más rápido is 5 = 5 minutes"
    },
    t4:{
      intersections:3,start:0,finish:1,
      expected:null
    },
    t5:{
      intersections:2,start:2,finish:3,
      expected:"[2, 3]. Tiempo más rápido is 2 = 2 minutes"
    },
    t6:{
      intersections:2,start:3,finish:2,
      expected:"[3, 2]. Tiempo más rápido is 2 = 2 minutes"
    },
    t7:{
      intersections:3,start:2,finish:4,
      expected:"[2, 3, 4]. Tiempo más rápido is 2 + 10 = 12 minutes"
    },
    t8:{
      intersections:2,start:2,finish:4,
      expected:"[2, 4]. Tiempo más rápido is 5 = 5 minutes"
    },
    t10:{
      intersections:5,start:0,finish:4,
      expected:"[0, 1, 3, 2, 4]. Tiempo más rápido is 5 + 2 + 2 + 5 = 14 minutes"        
    }
  }

  it("from 0 to 0 with 0 intersections",function(){
    const objtest = objtests.t0
    const result = navigate(objtest.intersections,roads,objtest.start,objtest.finish)
    expect(objtest.expected).toBe(result)
  })

  it("from 0 to 0 with 1 intersections",function(){
    const objtest = objtests.t1
    const result = navigate(objtest.intersections,roads,objtest.start,objtest.finish)
    expect(objtest.expected).toBe(result)
  })

  it("from 0 to 1 with 0 intersections",function(){
    const objtest = objtests.t2
    const result = navigate(objtest.intersections,roads,objtest.start,objtest.finish)
    expect(objtest.expected).toBe(result)
  })

  it("from 0 to 1 with 2 intersections",function(){
    const objtest = objtests.t3
    const result = navigate(objtest.intersections,roads,objtest.start,objtest.finish)
    expect(objtest.expected).toBe(result)
  })
  
  it("from 0 to 1 with 3 intersections",function(){
    const objtest = objtests.t4
    const result = navigate(objtest.intersections,roads,objtest.start,objtest.finish)
    expect(objtest.expected).toBe(result)
  })  

  it("from 2 to 3 with 2 intersections",function(){
    const objtest = objtests.t5
    const result = navigate(objtest.intersections,roads,objtest.start,objtest.finish)
    expect(objtest.expected).toBe(result)
  })

  it("from 3 to 2 with 2 intersections",function(){
    const objtest = objtests.t6
    const result = navigate(objtest.intersections,roads,objtest.start,objtest.finish)
    expect(objtest.expected).toBe(result)
  })

  it("from 2 to 4 with 3 intersections",function(){
    const objtest = objtests.t7
    const result = navigate(objtest.intersections,roads,objtest.start,objtest.finish)
    expect(objtest.expected).toBe(result)
  })

  it("from 2 to 4 with 2 intersections",function(){
    const objtest = objtests.t8
    const result = navigate(objtest.intersections,roads,objtest.start,objtest.finish)
    expect(objtest.expected).toBe(result)
  })

  it("ejemplo enunciado: from 0 to 4 with 5 intersections",function(){
    const objtest = objtests.t10
    const result = navigate(objtest.intersections,roads,objtest.start,objtest.finish)
    expect(objtest.expected).toBe(result)
  })
  
})
