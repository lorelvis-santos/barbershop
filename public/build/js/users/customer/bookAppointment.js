let step=1,slider=null,currentEmployeeContainer=null,currentTimeContainer=null;const appointment={name:"",date:"",time:"",services:[],totalPrice:0,userId:"",employee:{id:"",name:"",phone:"",email:"",roleId:"",role:"",image:""}};function init(){showSection(step),checkPagination(step),tabs(),setPagination(),setEmployeesSlider(),getServices(),getUserId(),getDate(),getAvailableTimes(),showSummary()}function tabs(){document.querySelectorAll(".tabs button").forEach((e=>{e.addEventListener("click",(e=>{step=e.target.dataset.step,showSection(step),checkPagination(step)}))}))}function setPagination(){const e=document.querySelector("#back"),t=document.querySelector("#next");e.addEventListener("click",(e=>{const t=parseInt(document.querySelector("button.current").dataset.step);t>1&&(showSection(t-1),checkPagination(t-1)),scrollTo(0,document.body.scrollHeight)})),t.addEventListener("click",(e=>{const t=parseInt(document.querySelector("button.current").dataset.step);t<2&&(showSection(t+1),checkPagination(t+1)),document.querySelector("#step-2").scrollIntoView()}))}function checkPagination(e){const t=document.querySelector("#back"),n=document.querySelector("#next");1==e?(t.classList.add("hide"),n.classList.remove("hide")):2==e&&(t.classList.remove("hide"),n.classList.add("hide"))}function showSection(e){const t=document.querySelector(`button[data-step="${e}"]`),n=document.querySelector("button.current"),i=document.querySelector(`#step-${e}`),a=document.querySelector(".show");2==e&&showSummary(),n&&n.classList.remove("current"),t.classList.add("current"),a&&a.classList.remove("show"),i.classList.add("show")}async function setEmployeesSlider(){slider=new KeenSlider("#employees",{mode:"snap",slides:{perView:1,spacing:20},dragSpeed:.8,breakpoints:{"(min-width: 768px)":{mode:"free-snap",slides:{perView:2,spacing:20}},"(min-width: 1400px)":{mode:"free-snap",slides:{perView:2,spacing:20}}}});const e=document.querySelector("#employees"),t=document.querySelectorAll("li.employee"),n=document.querySelectorAll(".arrow");t.forEach((e=>{e.onclick=async function(){employee=await getEmployee(e.dataset.id),employeeSelection(employee,e)}})),e.addEventListener("mousedown",(t=>{e.classList.add("dragging")})),e.addEventListener("mouseup",(t=>{e.classList.remove("dragging")})),n.forEach((e=>{e.addEventListener("click",(t=>{"right-employee"===e.id?slider.next():slider.prev()}))}))}async function getEmployee(e){try{const t=`/api/employees?id=${e}`,n=await fetch(t);return await n.json()}catch(e){console.error(e)}}function employeeSelection(e,t){let n=!1;null===currentEmployeeContainer?(currentEmployeeContainer=t,currentEmployeeContainer.classList.add("selected"),appointment.employee=e,n=!0):currentEmployeeContainer!=t&&(currentEmployeeContainer.classList.remove("selected"),currentEmployeeContainer=t,currentEmployeeContainer.classList.add("selected"),currentEmployeeContainer.roleId!=appointment.employee.roleId&&(n=!0),appointment.employee=e),n&&(getServices(),appointment.services=[]),""!=appointment.time&&(appointment.time=""),getAvailableTimes()}async function getServices(){if(""===appointment.employee.id)return showAlert("error","Debes de seleccionar un empleado",".services-container",!1),!1;try{const e=`/api/services?id=${appointment.employee.roleId}`,t=await fetch(e);showServices(await t.json())}catch(e){console.error(e)}}function showServices(e){const t="#services",n=document.querySelector(t);clearContainer(t),alert=document.querySelector(".services-container .alert"),null!=alert&&alert.remove(),e.length>0?e.forEach((e=>{const{id:t,name:i,price:a}=e,o=document.createElement("DIV"),r=document.createElement("P"),c=document.createElement("P");r.classList.add("service__name"),r.textContent=i,c.classList.add("service__price"),c.textContent=`RD$${a}`,o.classList.add("service"),o.classList.add("clickable"),o.dataset.serviceId=t,o.appendChild(r),o.appendChild(c),o.onclick=function(){serviceSelection(e)},n.appendChild(o)})):showAlert("error","No hay ningún servicio asociado a ese rol",".services-container",!1)}function serviceSelection(e){const{id:t}=e,{services:n}=appointment,i=n.includes(e),a=document.querySelector(`[data-service-id="${t}"]`);a&&(i?deleteService(e):(appointment.services.length>0&&deleteService(appointment.services[0]),appointment.services=[e],a.classList.add("selected")))}function deleteService(e){const{id:t}=e,n=document.querySelector(`[data-service-id="${t}"]`);n&&appointment.services.includes(e)&&(appointment.services=appointment.services.filter((t=>t.id!=e.id)),n.classList.remove("selected"))}function getUserId(){appointment.userId=document.querySelector("#userId").value}function getDate(){const e=document.querySelector("#date");datepicker=flatpickr(e,{minDate:"today",maxDate:(new Date).fp_incr(21),altInput:!0,altFormat:"l, j \\de F \\de Y",dateFormat:"Y-m-d",disable:[function(e){return 2===e.getDay()}],locale:{firstDayOfWeek:1,weekdays:{shorthand:["Do","Lu","Ma","Mi","Ju","Vi","Sa"],longhand:["Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"]},months:{shorthand:["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Оct","Nov","Dic"],longhand:["Enero","Febrero","Мarzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]}}}),e.addEventListener("input",(e=>{if(appointment.date=e.target.value,!appointment.employee.id)return clearContainer(".available-times"),showAlert("error","Debes de seleccionar un empleado",".available-times",!1),!1;getAvailableTimes()}))}function getTotalPrice(){if(0===appointment.services.length)return appointment.totalPrice=0,!1;let e=0;appointment.services.forEach((t=>{e+=parseFloat(t.price)})),appointment.totalPrice=e.toFixed(2)}async function getAvailableTimes(){if(""===appointment.date)return clearContainer(".available-times"),showAlert("error","Selecciona un empleado y luego la fecha",".available-times",!1),!1;try{const e=`/api/employees/availabletimes?id=${appointment.employee.id}&date=${appointment.date}`,t=await fetch(e);showAvailableTimes(await t.json())}catch(e){console.error(e)}}function showAvailableTimes(e){const t=".available-times";if(clearContainer(t),!e)return showAlert("error","No hay horarios disponibles para ese día",t,!1),!1;const n=document.querySelector(t);e.forEach((e=>{const t=document.createElement("LI");t.dataset.id=e.id,t.textContent=to12hr(e.time),t.classList.add("available-time"),t.onclick=function(){timeSelection(e,t)},n.appendChild(t)}))}function timeSelection(e,t){null===currentTimeContainer?(currentTimeContainer=t,currentTimeContainer.classList.add("selected"),appointment.time=e):currentTimeContainer!=t&&(currentTimeContainer.classList.remove("selected"),currentTimeContainer=t,currentTimeContainer.classList.add("selected"),appointment.time=e)}function showSummary(){clearContainer(".summary");const e=document.querySelector(".summary");if(0===appointment.services.length)return showAlert("error","Debes seleccionar mínimo un servicio",".summary",!1),!1;if(""===appointment.date||""===appointment.time)return showAlert("error","Debes seleccionar una fecha y una hora",".summary",!1),!1;const{date:t,time:n,services:i,employee:a}=appointment,o=formatDate(t),r=document.createElement("H2"),c=document.createElement("H3"),s=document.createElement("FORM"),l=document.createElement("H3"),d=document.createElement("DIV"),m=document.createElement("DIV"),p=document.createElement("BUTTON"),u=document.createElement("DIV"),h=document.createElement("P"),y=document.createElement("SPAN");r.textContent="Resumen";const v=[{id:"established-employee-name",label:"Te atenderá",inputInfo:a.name},{id:"established-date",label:"Fecha de la cita",inputInfo:capitalizeFirstLetter(o)},{id:"established-hour",label:"Hora establecida",inputInfo:to12hr(n.time)}];c.textContent="Información de la cita",c.classList.add("text-center"),s.classList.add("form"),v.forEach((e=>{const t=document.createElement("DIV"),n=document.createElement("LABEL"),i=document.createElement("INPUT");t.classList.add("field"),n.textContent=e.label,n.setAttribute("for",e.id),i.setAttribute("type","text"),i.setAttribute("id",e.id),i.setAttribute("value",e.inputInfo),i.setAttribute("disabled",!0),t.appendChild(n),t.appendChild(i),s.appendChild(t)})),l.textContent="Servicios seleccionados",l.classList.add("text-center"),i.forEach((e=>{const t=document.createElement("DIV"),n=document.createElement("P"),i=document.createElement("DIV"),a=document.createElement("DIV"),o=document.createElement("P"),r=deleteIconSVG(),{id:c,name:s,price:l}=e;n.textContent=s,n.classList.add("service__name"),o.textContent=`RD$${l}`,o.classList.add("service__price"),i.appendChild(n),i.appendChild(o),r.classList.add("clickable"),r.onclick=function(){if(deleteService(e),t.remove(),0===appointment.services.length)return showAlert("error","Debes seleccionar mínimo un servicio",".summary .services-container",!1),document.querySelector(".total-price").remove(),document.querySelector("#book-button").remove(),!1;getTotalPrice(),document.querySelector(".total-price span").textContent="RD$"+appointment.totalPrice},a.appendChild(r),a.classList.add("service__right"),t.appendChild(i),t.appendChild(a),t.classList.add("service-container"),d.appendChild(t),d.classList.add("services-container")})),getTotalPrice(),y.textContent="RD$"+appointment.totalPrice,h.textContent="Total a pagar: ",h.classList.add("total-price"),h.append(y),u.appendChild(h),u.classList.add("total-price-container"),p.classList.add("button"),p.textContent="Reservar",p.id="book-button",p.onclick=bookAppointment,m.classList.add("place-right"),m.appendChild(p),e.appendChild(r),e.appendChild(c),e.appendChild(s),e.appendChild(l),e.appendChild(d),e.appendChild(u),e.appendChild(m)}async function bookAppointment(){const e=appointment.services.map((e=>e.id)),{date:t,totalPrice:n,time:i,userId:a,employee:o}=appointment,r=new FormData;r.append("date",t),r.append("totalPrice",n),r.append("timeId",i.id),r.append("services",e),r.append("userId",a),r.append("employeeId",o.id);try{await fetch("/api/appointments",{method:"POST",body:r});Swal.fire({icon:"success",title:"Cita reservada",text:"Tu cita ha sido reservada correctamente!"}).then((()=>window.location.href="/cliente/mis-citas"))}catch(e){Swal.fire({icon:"error",title:"Oops...",text:"Ha ocurrido un error!",footer:`${e}`})}}document.addEventListener("DOMContentLoaded",(function(){init()}));