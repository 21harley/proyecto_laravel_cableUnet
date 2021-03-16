//require('./bootstrap');
let ban=0;
const montoApagar={"telefono":0,"cable":0,"internet":0};
window.addEventListener("click",(e)=>{
  //console.log(e.target);
  if(e.target.matches(".cbox")){
    const total=document.querySelectorAll(".cbox");
    if(total.length>0){
      const pago=document.querySelector("#costoCPT");
      const ipago=document.querySelector("#CPTpago");
      const icanales=document.querySelector("#canales");
      let monto=0;
      let aux="";
      total.forEach(el=>{
        if(el.checked){
          const cadenas=el.value.split("-");
          monto+=parseInt(cadenas[0],10);
          aux+="-"+cadenas[1];
        } 
      })
      pago.innerHTML=monto;
      ipago.value=monto;
      icanales.value=aux;
    }
  }
  if(e.target.matches("#tservicio")||e.target.matches(".option")){
    //console.log(e.target);
    const dato=document.querySelector("#datoE");
    switch(e.target.value){
      case "internet":
        dato.setAttribute("placeholder", "byte/s");
      break;
      case "cable":
        dato.setAttribute("placeholder", "plan");
      break;
      case "telefono":
        dato.setAttribute("placeholder", "tiempo");
      break;
    }
  }
  if(e.target.matches(".form-CP-input")||e.target.matches(".option1")){
    const costo=document.querySelector("#costoSCP");
    if(e.target.title=="paqueteT"&&e.target.value!=""){
      console.log(e.target.costo);
     costo.innerHTML=e.target.getAttribute('costo');
     const user=document.querySelector("#userp");
     const costp=document.querySelector("#costp");
     costp.value=e.target.getAttribute('costo');
    }else{
      if(costo!=null){
        costo.innerHTML="0";
      }
    }
  }
  if(e.target.matches("#telefonoT")||e.target.matches("#internetT")||e.target.matches("#cableT")||e.target.matches(".option")){
    const dato=document.querySelector("#costoCP");
    //console.log(e.target);
    switch(e.target.title){
      case "telefonoT":
        const ht=document.querySelector("#Htelefono");
        if(e.target.value!=="vacio"&&e.target.value!==""){
          const cadenas=e.target.value.split("-");
          montoApagar["telefono"]=parseInt(cadenas[0],10);
          ht.value=cadenas[1];
        }else{
          montoApagar["telefono"]=0;
          ht.value="";
        }
      break;
      case "cableT":
        const hc=document.querySelector("#Hcable");
        if(e.target.value!=="vacio"&&e.target.value!==""){
          const cadenas=e.target.value.split("-");
          montoApagar["cable"]=parseInt(cadenas[0],10);
          hc.value=cadenas[1];
        }else{
          montoApagar["cable"]=0;
          hc.value="";
        }        
      break;
      case "internetT":
        const hi=document.querySelector("#Hinternet");
        if(e.target.value!=="vacio"&&e.target.value!==""){
          const cadenas=e.target.value.split("-");
          montoApagar["internet"]=parseInt(cadenas[0],10);
          hi.value=cadenas[1];
        }else{
          montoApagar["internet"]=0;
          hi.value="";
        }       
      break;
    }
    let aux=0;
    for(let elemento in montoApagar) {
        aux+=montoApagar[elemento];
    };
    dato.innerHTML=aux;
    document.querySelector("#Hpago").value=aux;
  }
  if(e.target.matches(".menu-boton-img-logo")||e.target.matches(".login-logo")){
    location.href="../public";
  }
  if(e.target.matches(".login-form-username")){
    location.href="../public/newUser";
  }
  /*menu de settings admin*/
  if(e.target.matches(".main-user-settings-li")){
      const v=document.querySelector(".settingA");
      const v1=document.querySelector(".settings-active");
      const input=document.querySelectorAll(".input-A");
      const nameClass=[".CS",".CP",".F",".S",".U",".CC",".CPT"];
      let ban=0;
       input.forEach(element => {
        element.classList.remove("input-A");
      });
      
      v.classList.remove("settingA");
      v1.classList.remove("settings-active");
      e.target.classList.add("settings-active");
      switch(e.target.textContent){
          case "Crear Servicio":
            document.querySelector(".settings-show-CS").classList.add("settingA");
          break;
          case "Crear paquete Servicio":
            document.querySelector(".settings-show-CP").classList.add("settingA");ban=1;
          break;
          case "Factura":
            document.querySelector(".settings-show-F").classList.add("settingA");ban=2;
          break;
          case "Solicitud de Cambio":
            document.querySelector(".settings-show-S").classList.add("settingA");ban=3;
          break;
          case "Usuarios":
            document.querySelector(".settings-show-U").classList.add("settingA");ban=4;
          break;
          case "Cargar Canal":
            document.querySelector(".settings-show-CC").classList.add("settingA");ban=5;
          break;
          case "Crear Plan de Tv":
            document.querySelector(".settings-show-CPT").classList.add("settingA");ban=6;
          break;
    }   
    const input1=document.querySelectorAll(nameClass[ban]);
    input1.forEach(element => {
      element.classList.add("input-A");
    });
    
  }
  /*menu de settings user*/
  if(e.target.matches(".main-user-settings-li1")){
    const v=document.querySelector(".settingA");
    const v1=document.querySelector(".settings-active");
    const input=document.querySelectorAll(".input-A");
    const nameClass=[".SCP",".SCAP",".RF"];
    let ban=0;
     input.forEach(element => {
      element.classList.remove("input-A");
    });
    
    v.classList.remove("settingA");
    v1.classList.remove("settings-active");
    e.target.classList.add("settings-active");
    switch(e.target.textContent){
        case "Comprar Paquete":
          document.querySelector(".settings-show-SCP").classList.add("settingA");
        break;
        case "Cambio de Paquete":
          document.querySelector(".settings-show-SCAP").classList.add("settingA");ban=1;
        break;
        case "Registro facturas":
          document.querySelector(".settings-show-RF").classList.add("settingA");ban=2;
        break;
    }   
    const input1=document.querySelectorAll(nameClass[ban]);
    input1.forEach(element => {
      element.classList.add("input-A");
    });
  }

});
window.addEventListener("mouseover",(e)=>{
    const des=document.querySelector(".menu-options-des");
    if(e.target.matches(".menu-options-a")){
      switch(e.target.textContent){
          case "PRODUCTOS":
              des.style.display="block";ban=1;
          break;
      }
      e.target.classList.add("menu-active");
    }
    if(e.target.matches(".menu-options-des")){
        switch(ban){
            case 1:
               document.getElementById("PRODUCTOS").classList.toggle("menu-active");
            break;
        }
    }
    if(e.target.matches(".menu-boton-img"||".menu-boton-img *")||e.target.matches(".menu-boton-ul *"||".menu-boton-ul")){
        des.style.display="none";
    }
});
window.addEventListener("mouseout",(e)=>{
    if(e.target.matches(".menu-active")){
        e.target.classList.toggle("menu-active");
    }
    if(e.target.matches(".menu-active")||e.target.matches(".menu-options-des")){
        const des=document.querySelector(".menu-options-des");
        if(e.target.matches(".menu-options-des")&&ban===1){
            des.style.display="none";
            document.getElementById("PRODUCTOS").classList.toggle("menu-active");
        }
        if(e.target.matches(".menu-active")&&ban===1){
            des.style.display="none";
        }
        e.target.classList.toggle("menu-active");
    }
});
  