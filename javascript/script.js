document.getElementById("add").
addEventListener("click",()=>{
  const node = document.getElementById("js-unit-adder-son");
  const clone = node.cloneNode(true);
  //clone ke andar kafi sare element he
  //unme se input aur textarea bhi he jinke hamne value ko none kar diya jitne bhi he
  clone.querySelectorAll("input, textarea").forEach((element) => {
    element.value = "";
  });
  document.getElementById("js-unit-adder").appendChild(clone);
});

document.getElementById("remove").
addEventListener("click",()=>{
  const parent = document.getElementById("js-unit-adder")
  const uints = document.querySelectorAll("#js-unit-adder-son"); //all the elements with this id 
  //select all the elements with js-unit-adder-son and we know same elements can be use as an array
  if(uints.length > 1){
    parent.removeChild(uints[uints.length - 1]);
  }
});