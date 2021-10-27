$(()=>{

    console.log("funcionesHolded.js cargado");
    
    if($("#holded_table").length > 0)
        cargarClientesHolded(contactosHolded);   
        
    /*$("#holded_table tr").click((e)=>{
        
        padreid=e.currentTarget.id;
        let contacto = $("#"+padreid+" #usuario_nombre").text();
        let id = $("#"+padreid+" #usuario_id").text();
        let email = $("#"+padreid+" #usuario_email").text();

        $("#formulario_holded_mostrar #cliente_nombre").val(contacto);
        $("#formulario_holded_mostrar #cliente_id").val(id);
        $("#formulario_holded_mostrar #cliente_email").val(email);
        
    });*/
});

function cargarClientesHolded(contactosHolded){

    let rownumber=0;
    console.log(contactosHolded);
       $("#cliente_nombre").val(contactosHolded[0]["name"]);
       $("#cliente_id").val(contactosHolded[0]["id"]);
       $("#cliente_email").val(contactosHolded[0]["email"]);
       
       contactosHolded.forEach(element => {
        let row= "<tr id='row_" + rownumber +"'>"+
                     "<td id='usuario_nombre'>" + element.name + "</td>"+
                     "<td id='usuario_id'>" + element.id + "</td>"+
                     "<td id='usuario_email'>" + element.email + "</td>"+
                    "</tr>";      
        $("#holded_table tbody").append(row);
        rownumber++;
        
    });

}