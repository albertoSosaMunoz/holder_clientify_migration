$(()=>{

    if($("#table_clientify_personas_guzzle").length > 0)
        tablaPersonasClientifyGuzzle(personasClientify);
    if($("#table_clientify_empresas_guzzle").length > 0)
        tablaCompaniasClientifyGuzzle(companiasClientify);        

});


function tablaPersonasClientifyGuzzle(personasClientify){

    
    let elements=personasClientify.results;

    
    elements.forEach(element => {
        
        rows = "<tr>"+
                "<td>" + element.first_name + "</td>"+
                "</tr>";
        console.log(rows);
        $("#table_clientify_personas_guzzle tbody").append(rows);
    });

}

function tablaCompaniasClientifyGuzzle(companiasClientify){

    
    let elements=companiasClientify.results;

    
    elements.forEach(element => {
        
        rows = "<tr>"+
                "<td>" + element.name + "</td>"+
                "</tr>";
        console.log(rows);
        $("#table_clientify_empresas_guzzle tbody").append(rows);
    });

}
