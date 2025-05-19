function seleccionCategoria(id){
   const collection = document.getElementsByClassName("tableDato");
   const length = collection.length;

   for(let i=0; i<length; i++){
        collection[i].classList.remove("table-primary");
   }

   const radioCollection = document.getElementsByClassName("form-check-input");
   const lengthR = radioCollection.length;

   for(let j=0; j<lengthR; j++){
    radioCollection[j].checked = false;
   }
   

   var element = document.getElementById(id);
   var radioChecked = "radio" + id;

   document.getElementById(radioChecked).checked = true;

   element.classList.add("table-primary");
}