var url = 'http://localhost:8000/api';

function xmlhttp() {
    try
    {
        var xmlhttp = new XMLHttpRequest();
    }
    catch (err)
    {
        var xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
   return xmlhttp;
}




function salvar(){

    var nome = document.getElementById('nome').value;
    var grupo = document.getElementById('grupo').value;
    var continente = document.getElementById('continente').value;
    var id = document.getElementById('id').value;

    var params = encodeURI('nome='+nome+'&grupo='+grupo+'&continente='+continente);

    document.getElementById('btn-salvar').style.display = 'none';
    document.getElementById('loading-salvar').style.display = 'inline-block';

    var erroBlock = document.getElementById('error');
    erroBlock.innerHTML = "";

    var http = xmlhttp();
    if ( id != '' ) {
        http.open('PUT', url+"/times/"+id, true);
    } else {
        http.open('POST', url+"/times", true);
    }
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {
        if(http.readyState == 4 && http.status == 201) {

            document.getElementById('btn-salvar').style.display = 'inline-block';
            document.getElementById('loading-salvar').style.display = 'none';

            clearForm();
            listarGrupo();
            listarSelectGrupo();
        } else if(http.readyState == 4 && http.status == 422){
            document.getElementById('btn-salvar').style.display = 'inline-block';
            document.getElementById('loading-salvar').style.display = 'none';

            var resposta = JSON.parse( http.response );
            erroBlock.innerHTML = 'ERRO: <br>'
            for ( var i = 0 ; i < resposta['errors'].length ; i++ ) {
                erroBlock.innerHTML += resposta['errors'][i]+'<br>';
            }
        } else if(http.readyState == 4) {
            document.getElementById('btn-salvar').style.display = 'inline-block';
            document.getElementById('loading-salvar').style.display = 'none';
            erroBlock.innerHTML = "";
        }
    }
    http.send(params);


}

function openEdit( id ) {

    var http = xmlhttp();

    http.open("GET", url+"/times/"+id,true);
    http.responseType = 'json';
    http.onreadystatechange=function() {
        if (http.readyState==4){
            document.getElementById('formTilte').innerHTML = 'Alterar Time';
            document.getElementById('id').value = http.response['id'];
            document.getElementById('nome').value = http.response['nome'];
            document.getElementById('grupo').value = http.response['grupos_id'];
            document.getElementById('continente').value = http.response['continentes_id'];
            document.getElementById('btn-salvar').innerText = 'Alterar';
            document.getElementById('novo-salvar').style.display = 'inline-block';

        }
    }
    http.send(null);
}

function excluir( id ) {

    var http = xmlhttp();

    http.open("DELETE", url+"/times/"+id,true);
    http.responseType = 'json';
    http.onreadystatechange=function() {
        if (http.readyState==4){
            clearForm();
            listarGrupo();
            listarSelectGrupo();
        }
    }
    http.send(null);

}


function clearForm(){
    document.getElementById('id').value = '';
    document.getElementById('nome').value = '';
    document.getElementById('grupo').value = '';
    document.getElementById('continente').value = '';
    document.getElementById('formTilte').innerHTML = 'Salvar Times';
    document.getElementById('btn-salvar').innerText = 'Salvar';
    document.getElementById('novo-salvar').style.display = 'none';
}

function listarGrupo(){
    var http = xmlhttp();

    var grupos = document.getElementById('block-grupos');
    grupos.innerHTML = "Carregando...";
    http.open("GET", url+"/grupos",true);
    http.responseType = 'json';
    http.onreadystatechange=function() {
        if (http.readyState==4){
            var resposta = http.response;
            if ( resposta.length > 0 ) {
                grupos.innerHTML = '';
                for ( var i = 0 ; i < resposta.length ; i++ ) {
                    var times = resposta[i]['times'];
                    var timesBlock = '';
                    for ( var j = 0 ; j < times.length ; j++ ) {
                        timesBlock += "<span>" + times[j]['nome'] +'' +
                                      '<button type="button" onclick="openEdit('+times[j]['id']+')" >Editar</button>' +
                                      '<button type="button" onclick="excluir('+times[j]['id']+')" >Excluir</button>' +
                                      '</span>';
                    }
                    grupos.innerHTML += '<div class="list-times"><h1>'+ resposta[i]['nome']+' </h1> '+timesBlock+'</div>';
                }

            } else {
                grupos.innerHTML = 'Nenhum Grupo cadastrado...';
            }
        } else {
            grupos.innerHTML = 'Ocorreu um erro ao trazer os grupos';
        }
    }
    http.send(null);
}

function listarSelectGrupo(){

    var http = xmlhttp();

    var grupos = document.getElementById('grupo');
    grupos.innerHTML = '<option value="" >Carregando...</option>';
    http.open("GET", url+"/grupos",true);
    http.responseType = 'json';
    http.onreadystatechange=function() {
        if (http.readyState==4){
            var resposta = http.response;
            if ( resposta.length > 0 ) {
                grupos.innerHTML = '';
                for ( var i = 0 ; i < resposta.length ; i++ ) {
                    grupos.innerHTML += '<option value="'+resposta[i]['id']+'" >' + resposta[i]['nome'] + ' ( ' + resposta[i]['times'].length +  ')</option>';
                }

            } else {
                grupos.innerHTML = '<option value="" >Nenhum Grupo cadastrado...</option>';
            }
        } else {
            grupos.innerHTML = '<option value="" >Ocorreu um erro ao trazer os grupos</option>';
        }
    }
    http.send(null);

}

function listarSelectContinente(){
    var http = xmlhttp();

    var continente = document.getElementById('continente');
    continente.innerHTML = '<option value="" >Carregando...</option>';
    http.open("GET", url+"/continentes",true);
    http.responseType = 'json';
    http.onreadystatechange=function() {
        if (http.readyState==4){
            var resposta = http.response;
            if ( resposta.length > 0 ) {
                continente.innerHTML = '';
                for ( var i = 0 ; i < resposta.length ; i++ ) {
                    continente.innerHTML += '<option value="'+resposta[i]['id']+'" >' + resposta[i]['nome'] + '</option>';
                }

            } else {
                continente.innerHTML = '<option value="" >Nenhum Continente cadastrado...</option>';
            }
        } else {
            continente.innerHTML = '<option value="" >Ocorreu um erro ao trazer os Continentes</option>';
        }
    }
    http.send(null);
}

listarGrupo();
listarSelectGrupo();
listarSelectContinente();

