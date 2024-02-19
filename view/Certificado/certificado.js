const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

const image = new Image();
const imageqr = new Image();
let documentDataLoaded = false;

window.onload = function() {
    if (!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}



$(document).ready(function() {
    var docd_id = getUrlParameter('docd_id');

    $.post("../../controller/usuario.php?op=mostrar_documento_detalle", { docd_id: docd_id }, function(data) {
        console.log("Respuesta del servidor:", data);

        data = JSON.parse(data);


        image.onload = function () {
            imageqr.onload = function () {
                documentDataLoaded = true;
                displayContent(data);
            };

            imageqr.src = "../../public/qr/" + docd_id + ".png";
        };
        image.src = data.doc_img;
        ctx.drawImage(image, 0, 0, canvas.width, canvas.height);


  
    });


});

$(document).on("click", "#btnpng", function() {
    let lblpng = document.createElement('a');
    lblpng.download = "Certificado.png";
    lblpng.href = canvas.toDataURL();
    lblpng.click();
});

$(document).on("click", "#btnpdf", function() {
    var imgData = canvas.toDataURL('image/png');

    // Crear una instancia de jsPDF con orientación 'p' (vertical) y dimensiones A4
    var doc = new jsPDF('p', 'mm', 'a4');

    // Establecer márgenes mínimos
    var marginLeft = 5;  // Márgen izquierdo en mm
    var marginTop = 5;   // Márgen superior en mm

    // Calcular las dimensiones para centrar la imagen dentro de los márgenes
    var imgWidth = doc.internal.pageSize.width - 2 * marginLeft;
    var imgHeight = (imgWidth / canvas.width) * canvas.height;

    // Calcular la posición para centrar la imagen en los márgenes
    var x = marginLeft;
    var y = marginTop + (doc.internal.pageSize.height - 2 * marginTop - imgHeight) / 2;

    // Agregar la imagen al PDF
    doc.addImage(imgData, 'PNG', x, y, imgWidth, imgHeight);

    // Guardar el PDF
    doc.save('Certificado.pdf');
});

function displayContent(data) {

    if (image.complete && imageqr.complete && documentDataLoaded) {
        if (data.doc_id === "1") {
            /* Definimos tamaño de la fuente */
            ctx.font = '15px Arial';
            ctx.textAlign = "left";
            ctx.textBaseline = 'middle';
            var x = 58;
            var y = 460;
            var lineHeight = 25;
            var maxWidth = canvas.width - 100;
        
            ctx.font = '15px Arial';
            ctx.fillText(data.doc_nom+ ' N° ' +data.doc_num + ' - '+obtenerAnio()+' - UNSCH/EPG', x-8, 210);
            
            var directorText ='EL DIRECTOR DE LA ESCUELA DE POSGRADO DE LA UNIVERSIDAD NACIONAL DE SAN CRISTÓBAL DE HUAMANGA QUE SUSCRIBE;';
            /* ctx.fillText(directorText, x, 320); */
            

            justificarTexto(ctx,'15px Arial',directorText, maxWidth, x, 330, lineHeight);

            ctx.font = '15px Arial';
            ctx.fillText('DEJA CONSTANCIA QUE:', x-8, 390);


            var encaText = data.usu_nom + ' ' + data.usu_apep + ' ' + data.usu_apem ;

            
            centrarTextoEnLinea(ctx, toTitleCase(encaText), 100, maxWidth, 650, '20px Arial');
            
        
  

            var text = "Con código de estudiante N° "+data.usu_cod_estudiante+" y con DNI N° "+data.usu_dni+", es egresado de la "+toTitleCase(data.posg_nom)+", de la Unidad de Posgrado de la "+toTitleCase(data.fac_nom)+", inició sus estudios en el semestre académico "+data.sem_nom_ingreso+" de fecha "+formatearFecha(data.sem_fech_inicio_ingreso)+". Se expide la presente a solicitud escrita del interesado, para los fines que considere conveniente.  ";
            justificarTexto(ctx,'15px Arial', text, maxWidth, x, y+20, lineHeight);

        


            ctx.font = '10px Arial';
            ctx.fillText('cc', x+28, 670);

            ctx.font = '10px Arial';
            ctx.fillText('Archivo', x+17, 680);

            ctx.font = '10px Arial';
            ctx.fillText('B/V N° '+data.num_boleta, x, 690);

            ctx.font = '10px Arial';
            ctx.fillText(data.unidad_perteneciente.toUpperCase() + "/"+data.iniciales_encargado.toUpperCase(), x+11, 700);


            var footer = "Esta es una copia auténtica imprimible de un documento electrónico archivado por la Escuela de Posgrado de la Universidad Nacional San Cristóbal de Huamanga. Su autenticidad e integridad pueden ser contrastadas a través de la siguiente dirección web: https://posgrado/GeneradorConstancia/view/Consulta/ e ingresando el siguiente código de DNI: "+data.usu_dni;
            justificarTexto(ctx,'10px Arial',footer, maxWidth-70, x, 765, 11);


       
        } 
        else if (data.doc_id === "2") {
                /* Definimos tamaño de la fuente */
            ctx.font = '15px Arial';
            ctx.textAlign = "left";
            ctx.textBaseline = 'middle';
            var x = 58;
            var y = 430;
            var lineHeight = 25;
            var maxWidth = canvas.width - 100;
        
            ctx.font = '15px Arial';
            ctx.fillText(data.doc_nom+ ' N° ' +data.doc_num + ' - '+obtenerAnio()+' - UNSCH/EPG', x-8, 210);
            
            var directorText ='EL DIRECTOR DE LA ESCUELA DE POSGRADO DE LA UNIVERSIDAD NACIONAL DE SAN CRISTÓBAL DE HUAMANGA. HACE CONSTAR QUE;';
            justificarTexto(ctx,'15px Arial',directorText, maxWidth, x, 325, lineHeight);



            var encaText = data.usu_nom + ' ' + data.usu_apep + ' ' + data.usu_apem ;
            centrarTextoEnLinea(ctx, encaText, 100, maxWidth, 620, '20px Arial');
  
            var text = "Con código de estudiante N° "+data.usu_cod_estudiante+" y con DNI N° "+data.usu_dni+", es egresado de la "+toTitleCase(data.posg_nom)+", de la Unidad de Posgrado de la "+toTitleCase(data.fac_nom)+",concluyó sus estudios en el semestre académico "+data.sem_nom_actual+" de fecha "+formatearFecha(data.sem_fech_fin_actual)+"." ;
            justificarTexto(ctx,'15px Arial', text, maxWidth, x, y+20, lineHeight);

            var seg="Se expide la presente a solicitud escrita del interesado, para los fines que considere conveniente.  ";
            justificarTexto(ctx,'15px Arial', seg, maxWidth, x, y+130, lineHeight);
        


            centrarTextoEnLinea(ctx, obtenerFechaActualComoPalabras(), 100, maxWidth, 1050, '15px Arial');

            ctx.font = '10px Arial';
            ctx.fillText('cc', x+28, 670);

            ctx.font = '10px Arial';
            ctx.fillText('Archivo', x+17, 680);

            ctx.font = '10px Arial';
            ctx.fillText('B/V N° '+data.num_boleta, x, 690);

            ctx.font = '10px Arial';
            ctx.fillText(data.unidad_perteneciente.toUpperCase() + "/"+data.iniciales_encargado.toUpperCase(), x+11, 700);


            var footer = "Esta es una copia auténtica imprimible de un documento electrónico archivado por la Escuela de Posgrado de la Universidad Nacional San Cristóbal de Huamanga. Su autenticidad e integridad pueden ser contrastadas a través de la siguiente dirección web: https://posgrado/GeneradorConstancia/view/Consulta/ e ingresando el siguiente código de DNI: "+data.usu_dni;;
            justificarTexto(ctx,'10px Arial',footer, maxWidth-70, x, 765, 11);
}
        else if (data.doc_id === "3") {
            /* Definimos tamaño de la fuente */
        ctx.font = '15px Arial';
        ctx.textAlign = "left";
        ctx.textBaseline = 'middle';
        var x = 58;
        var y = 430;
        var lineHeight = 25;
        var maxWidth = canvas.width - 100;
    
        ctx.font = '15px Arial';
        ctx.fillText(data.doc_nom+ ' N° ' +data.doc_num + ' - '+obtenerAnio()+' - UNSCH/EPG', x-8, 210);
        
        var directorText ='EL DIRECTOR DE LA ESCUELA DE POSGRADO DE LA UNIVERSIDAD NACIONAL DE SAN CRISTÓBAL DE HUAMANGA. HACE CONSTAR QUE;';
        justificarTexto(ctx,'15px Arial',directorText, maxWidth, x, 325, lineHeight);

        var encaText = data.usu_nom + ' ' + data.usu_apep + ' ' + data.usu_apem ;
        centrarTextoEnLinea(ctx, encaText, 100, maxWidth, 620, '20px Arial');
        
        var text = "Con código de estudiante N° "+data.usu_cod_estudiante+" y con DNI N° "+data.usu_dni+", es estudiante del"+" Ciclo de la "+toTitleCase(data.posg_nom)+", de la Unidad de Posgrado de la "+toTitleCase(data.fac_nom) +".";
        justificarTexto(ctx,'15px Arial', text, maxWidth, x, y+20, lineHeight);

        var seg="Se expide la presente a solicitud escrita del interesado, para los fines que considere conveniente.  ";
        justificarTexto(ctx,'15px Arial', seg, maxWidth, x, y+110, lineHeight);
    

        centrarTextoEnLinea(ctx, obtenerFechaActualComoPalabras(), 100, maxWidth, 1000, '15px Arial');

        ctx.font = '10px Arial';
        ctx.fillText('cc', x+28, 670);

        ctx.font = '10px Arial';
        ctx.fillText('Archivo', x+17, 680);

        ctx.font = '10px Arial';
        ctx.fillText('B/V N° '+data.num_boleta, x, 690);

        ctx.font = '10px Arial';
        ctx.fillText(data.unidad_perteneciente.toUpperCase() + "/"+data.iniciales_encargado.toUpperCase(), x+11, 700);


        var footer = "Esta es una copia auténtica imprimible de un documento electrónico archivado por la Escuela de Posgrado de la Universidad Nacional San Cristóbal de Huamanga. Su autenticidad e integridad pueden ser contrastadas a través de la siguiente dirección web: https://posgrado/GeneradorConstancia/view/Consulta/ e ingresando el siguiente código de DNI: "+data.usu_dni;
        justificarTexto(ctx,'10px Arial',footer, maxWidth-70, x, 765, 11);
}
        else if (data.doc_id === "4") {
            /* Definimos tamaño de la fuente */
                ctx.font = '15px Arial';
                ctx.textAlign = "left";
                ctx.textBaseline = 'middle';
                var x = 58;
                var y = 430;
                var lineHeight = 25;
                var maxWidth = canvas.width - 100;
            
                ctx.font = '15px Arial';
                ctx.fillText(data.doc_nom+ ' N° ' +data.doc_num + ' - '+obtenerAnio()+' - UNSCH/EPG', x-8, 210);
                
                var directorText ='EL DIRECTOR DE LA ESCUELA DE POSGRADO DE LA UNIVERSIDAD NACIONAL DE SAN CRISTÓBAL DE HUAMANGA.';
                justificarTexto(ctx,'15px Arial',directorText, maxWidth, x, 260, lineHeight);

                ctx.font = '15px Arial';
                ctx.fillText('HACE:', x-8, 330);

            
                centrarTextoEnLinea(ctx, "CONSTAR", 100, maxWidth, 520, '30px Arial');

                
                var nomb="Que, don "+data.usu_nom+" "+data.usu_apep+" "+data.usu_apem+", es egresado de la "+toTitleCase(data.posg_nom)+", NO ADEUDA por ningún concepto a la Escuela de Posgrado.";
            justificarTexto(ctx,'15px Arial', nomb, maxWidth, x, y-15, lineHeight);

                var seg="Así registra en los archivos, que obran en la Escuela de Posgrado, a los que me remito para los casos que hubiera lugar. ";
                justificarTexto(ctx,'15px Arial', seg, maxWidth, x, y+70, lineHeight);

                var ter="Se expide la presente a solicitud escrita del interesado, para los fines que considere conveniente.  ";
                justificarTexto(ctx,'15px Arial', ter, maxWidth, x, y+130, lineHeight);
            


                centrarTextoEnLinea(ctx, obtenerFechaActualComoPalabras(), 100, maxWidth, 1030, '15px Arial');

                ctx.font = '10px Arial';
                ctx.fillText('cc', x+28, 670);

                ctx.font = '10px Arial';
                ctx.fillText('Archivo', x+17, 680);

                ctx.font = '10px Arial';
                ctx.fillText('B/V N° '+data.num_boleta, x, 690);

                ctx.font = '10px Arial';
                ctx.fillText(data.unidad_perteneciente.toUpperCase() + "/"+data.iniciales_encargado.toUpperCase(), x+11, 700);


                var footer = "Esta es una copia auténtica imprimible de un documento electrónico archivado por la Escuela de Posgrado de la Universidad Nacional San Cristóbal de Huamanga. Su autenticidad e integridad pueden ser contrastadas a través de la siguiente dirección web: https://posgrado/GeneradorConstancia/view/Consulta/ e ingresando el siguiente código de DNI: "+data.usu_dni;
                justificarTexto(ctx,'10px Arial',footer, maxWidth-70, x, 765, 11);
        }
        else if (data.doc_id === "5") {

            var valorDocdId = data.docd_id;
            $.post("../../controller/usuario.php?op=mostrar_documento_detalle_tesis", { docd_id: valorDocdId }, function(tesisData) {
                tesisData = JSON.parse(tesisData);
                // Handle the data for mostrar_documento_detalle_tesis
            
                // Set up initial position for the table
                var x = 50;
                var y = 460;
                var cellWidth = 120;
                var cellHeight = 20;
            
                // Draw table headers
                ctx.font = 'bold 15px Arial';
                ctx.fillText('Sigla', x, y);
                ctx.fillText('Curso Nombre', x + cellWidth, y);
                ctx.fillText('Nota', x + 2.5 * cellWidth, y);
                ctx.fillText('Fecha', x + 3.5 * cellWidth, y);
            
                // Draw table data
                ctx.font = '15px Arial';
                for (let i = 0; i < tesisData.length; i++) {
                    // Draw a rectangle as the background for each cell
                    ctx.fillStyle = '#ffffff';
                    ctx.fillRect(x, y + (i + 1) * cellHeight, cellWidth, cellHeight);
                    ctx.fillRect(x + cellWidth, y + (i + 1) * cellHeight, cellWidth, cellHeight);
                    ctx.fillRect(x + 2 * cellWidth, y + (i + 1) * cellHeight, cellWidth, cellHeight);
                    ctx.fillRect(x + 3 * cellWidth, y + (i + 1) * cellHeight, cellWidth, cellHeight);
            
                    // Draw text in each cell
                    ctx.fillStyle = '#000000';
                    ctx.fillText(tesisData[i].cur_sigla, x, y + (i + 1) * cellHeight + 15);
                    ctx.fillText(tesisData[i].curso_nom, x + cellWidth, y + (i + 1) * cellHeight + 15);
                    ctx.fillText(tesisData[i].nota_maxima, x + 2.5 * cellWidth, y + (i + 1) * cellHeight + 15);
                    var fecha = new Date(tesisData[i].cur_fecha);
                    var formattedDate = fecha.getDate().toString().padStart(2, '0') + '/' + (fecha.getMonth() + 1).toString().padStart(2, '0') + '/' + fecha.getFullYear();
                    ctx.fillText(formattedDate, x + 3.4 * cellWidth, y + (i + 1) * cellHeight + 15);
                }
            });
            
            
                        /* Definimos tamaño de la fuente */
                    ctx.font = '15px Arial';
                    ctx.textAlign = "left";
                    ctx.textBaseline = 'middle';
                    var x = 58;
                    var y = 430;
                    var lineHeight = 25;
                    var maxWidth = canvas.width - 100;
                
                    ctx.font = '15px Arial';
                    ctx.fillText('CONSTANCIA HAI N° ' +data.doc_num + ' - '+obtenerAnio()+' - UNSCH/EPG', x-8, 210);
                    
                    var directorText ='EL DIRECTOR DE LA ESCUELA DE POSGRADO DE LA UNIVERSIDAD NACIONAL DE SAN CRISTÓBAL DE HUAMANGA.';
                    justificarTexto(ctx,'15px Arial',directorText, maxWidth, x, 250, lineHeight);

                    ctx.font = '15px Arial';
                    ctx.fillText('HACE:', x-8, 315);

                
                    centrarTextoEnLinea(ctx, "CONSTAR", 100, maxWidth,490, '30px Arial');

                    
                    var nomb="Que, don "+data.usu_nom+" "+data.usu_apep+" "+data.usu_apem+", es egresado de la "+toTitleCase(data.posg_nom)+", ha llevado las asignaturas siguientes: ";
                justificarTexto(ctx,'15px Arial', nomb, maxWidth, x, y-30, lineHeight);

                    var seg="Así registra en los archivos, que obran en la Escuela de Posgrado, a los que me remito para los casos que hubiera lugar. ";
                    justificarTexto(ctx,'15px Arial', seg, maxWidth, x, y+115, lineHeight);

                    var ter="Se expide la presente a solicitud escrita del interesado, para los fines que considere conveniente.  ";
                    justificarTexto(ctx,'15px Arial', ter, maxWidth, x, y+165, lineHeight);
                


                    centrarTextoEnLinea(ctx, obtenerFechaActualComoPalabras(), 100, maxWidth, 1080, '15px Arial');

                    ctx.font = '10px Arial';
                    ctx.fillText('cc', x+28, 670);

                    ctx.font = '10px Arial';
                    ctx.fillText('Archivo', x+17, 680);

                    ctx.font = '10px Arial';
                    ctx.fillText('B/V N° '+data.num_boleta, x, 690);

                    ctx.font = '10px Arial';
                    ctx.fillText(data.unidad_perteneciente.toUpperCase() + "/"+data.iniciales_encargado.toUpperCase(), x+11, 700);


                    var footer = "Esta es una copia auténtica imprimible de un documento electrónico archivado por la Escuela de Posgrado de la Universidad Nacional San Cristóbal de Huamanga. Su autenticidad e integridad pueden ser contrastadas a través de la siguiente dirección web: https://posgrado/GeneradorConstancia/view/Consulta/ e ingresando el siguiente código de DNI: "+data.usu_dni;
                    justificarTexto(ctx,'10px Arial',footer, maxWidth-70, x, 765, 11);
}
        else if (data.doc_id === "6") {/* Definimos tamaño de la fuente */
        ctx.font = '15px Arial';
        ctx.textAlign = "left";
        ctx.textBaseline = 'middle';
        var x = 58;
        var y = 460;
        var lineHeight = 25;
        var maxWidth = canvas.width - 100;
    
        ctx.font = '15px Arial';
        ctx.fillText(data.doc_nom+ ' N° ' +data.doc_num + ' - '+obtenerAnio()+' - UNSCH/EPG', x-8, 210);
        
        var directorText ='EL DIRECTOR DE LA ESCUELA DE POSGRADO DE LA UNIVERSIDAD NACIONAL DE SAN CRISTÓBAL DE HUAMANGA QUE SUSCRIBE;';
        /* ctx.fillText(directorText, x, 320); */
        

        justificarTexto(ctx,'15px Arial',directorText, maxWidth, x, 330, lineHeight);

        ctx.font = '15px Arial';
        ctx.fillText('DEJA CONSTANCIA QUE:', x-8, 390);


        var encaText = data.usu_nom + ' ' + data.usu_apep + ' ' + data.usu_apem ;
        var encaTextWidth = ctx.measureText(encaText).width;
    
        ctx.font = '20px Arial';
        
        // Calculate the height of the text
        var encaTextHeight = lineHeight;
        var encaTextLines = encaText.split(' ');
        for (var i = 1; i < encaTextLines.length; i++) {
            encaTextHeight += lineHeight;
        }
    
        // Calculate the y-position to center the text vertically
        var encaTextY = 455 + (lineHeight - encaTextHeight) / 2;
    
        ctx.fillText(encaText, canvas.width / 2 - encaTextWidth / 2, encaTextY);
    
        ctx.font = '15px Arial';
        // ...
    


        var text = "Con código de estudiante N° "+data.usu_cod_estudiante+" y con DNI N° "+data.usu_dni+", es egresado de la "+data.posg_nom+", de la Unidad de Posgrado de la "+data.fac_nom+", Inició sus estudios en el semestre académico "+data.sem_nom+". De fecha "+data.sem_fech_inicio+". Se expide la presente a solicitud escrita del interesado, para los fines que considere conveniente  ";
        justificarTexto(ctx,'15px Arial', text, maxWidth, x, y+10, lineHeight);

    


        ctx.font = '10px Arial';
        ctx.fillText('cc', x+28, 640);

        ctx.font = '10px Arial';
        ctx.fillText('Archivo', x+17, 650);

        ctx.font = '10px Arial';
        ctx.fillText('B/V N° '+data.num_boleta, x, 660);

        ctx.font = '10px Arial';
        ctx.fillText(data.unidad_perteneciente.toUpperCase() + "/"+data.iniciales_encargado.toUpperCase(), x+11, 670);


        var footer = "Esta es una copia auténtica imprimible de un documento electrónico archivado por la Escuela de Posgrado de la Universidad Nacional San Cristóbal de Huamanga. Su autenticidad e integridad pueden ser contrastadas a través de la siguiente dirección web: https://posgrado/GeneradorConstancia/view/Consulta/ e ingresando el siguiente código de DNI: "+data.usu_dni;
        justificarTexto(ctx,'10px Arial',footer, maxWidth-70, x, 750, 11);
}else {
            console.log("otro código");
        }

        ctx.drawImage(imageqr, 480, 735, 100, 100);
    }
}
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function drawJustifiedText(ctx, text, x, y, maxWidth, lineHeight) {
    var words = text.split(' ');
    var line = '';

    for (var i = 0; i < words.length; i++) {
        var testLine = line + words[i] + ' ';
        var metrics = ctx.measureText(testLine);
        var testWidth = metrics.width;

        if (testWidth > maxWidth && i > 0) {
            ctx.fillText(line, x, y);
            line = words[i] + ' ';
            y += lineHeight;
        } else {
            line = testLine;
        }
    }

    ctx.fillText(line, x, y);
}

function  obtenerAnio() {
    var  d = new  Date();
    var  n = d.getFullYear();
    return  n;
  }

function contar() {
$.post("../../controller/documento.php?op=contar_documento", function (data) {
    // Parsear la respuesta JSON
    var jsonData = JSON.parse(data);

    // Acceder al valor de la cuenta y mostrarlo en el elemento con id 'total'
    $('#total').html(jsonData.count);
});
}


function justificarTexto(ctx, fuente, text, maxWidth, x, y, lineHeight) {
    var words = text.split(' ');
    var currentLine = words[0];
    ctx.font = fuente;

    // Ajustar la posición x solo para la primera línea
    x -= 7;

    for (var i = 1; i < words.length; i++) {
        var testLine = currentLine + ' ' + words[i];
        var metrics = ctx.measureText(testLine);

        if (i === 1 && metrics.width < maxWidth) {
            // Si es la primera palabra, y la primera línea no excede el ancho máximo, no agregamos un espacio al principio
            currentLine = testLine;
        } else if (metrics.width < maxWidth) {
            currentLine = testLine;
        } else {
            var spaceWidth = (maxWidth - ctx.measureText(currentLine.replace(/\s/g, '')).width) / (currentLine.split(' ').length - 1);
            var wordsInLine = currentLine.split(' ');

            for (var j = 0; j < wordsInLine.length; j++) {
                ctx.fillText(wordsInLine[j], x, y);
                x += ctx.measureText(wordsInLine[j]).width + spaceWidth;
            }

            currentLine = words[i];
            y += lineHeight;
            x = 50;  // Restablecer x para las líneas subsiguientes
        }
    }

    // Dibujar la última línea
    ctx.fillText(currentLine, x, y); // Mover la primera línea hacia la izquierda en 5 píxeles
}
function justificarTextoDerecha(ctx, fuente, text, maxWidth, x, y, lineHeight) {
    var words = text.split(' ');
    var currentLine = words[0];
    ctx.font = fuente;

    // Ajustar la posición x para justificar a la derecha
    x = x - maxWidth;

    for (var i = 1; i < words.length; i++) {
        var testLine = currentLine + ' ' + words[i];
        var metrics = ctx.measureText(testLine);

        if (i === 1 && metrics.width < maxWidth) {
            // Si es la primera palabra, y la primera línea no excede el ancho máximo, no agregamos un espacio al principio
            currentLine = testLine;
        } else if (metrics.width < maxWidth) {
            currentLine = testLine;
        } else {
            var spaceWidth = (maxWidth - ctx.measureText(currentLine.replace(/\s/g, '')).width) / (currentLine.split(' ').length - 1);
            var wordsInLine = currentLine.split(' ');

            for (var j = 0; j < wordsInLine.length; j++) {
                ctx.fillText(wordsInLine[j], x, y);
                x += ctx.measureText(wordsInLine[j]).width + spaceWidth;
            }

            currentLine = words[i];
            y += lineHeight;
            x = x - maxWidth;  // Restablecer x para las líneas subsiguientes
        }
    }

    // Dibujar la última línea
    ctx.fillText(currentLine, x, y); // Justificar a la derecha
}


function centrarTextoEnLinea(ctx, texto, y, anchoLinea, altoLinea, fuente) {
    // Establecer la fuente
    ctx.font = fuente;

    // Medir el ancho del texto
    var anchoTexto = ctx.measureText(texto).width;

    // Calcular la posición x para centrar horizontalmente
    var xCentrado = (ctx.canvas.width - anchoTexto) / 2;

    // Calcular la posición y para centrar verticalmente
    var yCentrado = y + (altoLinea / 2) + (parseInt(ctx.font) / 3); // Ajuste para centrar verticalmente

    // Dibujar el texto centrado en la línea específica
    ctx.fillText(texto, xCentrado, yCentrado);
}

function obtenerFechaActualComoPalabras() {
    var meses = [
        "enero", "febrero", "marzo", "abril", "mayo", "junio",
        "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"
    ];


    var fechaActual = new Date();
    var dia = fechaActual.getDate();
    var mes = fechaActual.getMonth();
    var año = fechaActual.getFullYear();
    var diaSemana = fechaActual.getDay();

    var fechaComoPalabras =  "Ayacucho, " + dia + ' de ' + meses[mes] + ' de ' + año;

    return fechaComoPalabras;
}


function formatearFecha(fecha) {
    // Si la fecha es una cadena de texto, conviértela a un objeto Date
    if (typeof fecha === 'string') {
        // Extrae los componentes de la fecha en formato "0001-01-21"
        const partes = fecha.split('-');

        // Obtiene el día, el mes y el año
        const dia = String(Number(partes[2])).padStart(2, '0');
        const mes = String(Number(partes[1])).padStart(2, '0');
        const anio = Number(partes[0]);

        // Retorna la fecha formateada en DD/MM/AAAA
        return `${dia}/${mes}/${anio}`;
    }

    // Verifica si la conversión fue exitosa antes de continuar
    if (isNaN(fecha.getTime())) {
        console.error('La fecha proporcionada no es válida');
        return null;
    }

    // Formatea la fecha en DD/MM/AAAA
    const dia = String(fecha.getDate()).padStart(2, '0');
    const mes = String(fecha.getMonth() + 1).padStart(2, '0'); // Se suma 1 porque los meses van de 0 a 11
    const anio = fecha.getFullYear();

    return `${dia}/${mes}/${anio}`;
}

function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
}

