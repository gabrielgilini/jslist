<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>List test</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css">
            body{
                font-family:Arial, Helvetica, sans-serif;
                font-size:16px;
            }
            .info, .success, .warning, .error {
                border: 1px solid;
                margin: 10px 0px;
                padding:15px 10px 15px 50px;
                background-repeat: no-repeat;
                background-position: 10px center;
            }
            .info {
                color: #00529B;
                background-color: #BDE5F8;
                background-image: url('img/info.png');
            }
            .success {
                color: #4F8A10;
                background-color: #DFF2BF;
                background-image:url('img/success.png');
            }
            .warning {
                color: #9F6000;
                background-color: #FEEFB3;
                background-image: url('img/warning.png');
            }
            .error {
                color: #D8000C;
                background-color: #FFBABA;
                background-image: url('img/error.png');
            }
        </style>
        <script type="text/javascript" src="list.js"></script>
        <script type="text/javascript">
            window.API = {};
            (function(){
                var l, d = document, msgTimer;

                function _show(el){
                    el.style.display = 'block';
                    if(msgTimer){
                        window.clearTimeout(msgTimer);
                    }
                    msgTimer = window.setTimeout(function(){ _hide(el) }, 3000);
                    l && _updateList();
                }

                function _hide(el){
                    el.style.display = 'none';
                    msgTimer = null;
                }

                function _updateList(){
                    var listArr = l.getValuesArray()
                        valString = '[ ' + listArr.join(' -> ') + ' ]',
                        listDiv = d.getElementById('list');

                    listDiv.innerHTML = valString;
                    listDiv = null;
                }

                API.createList = function createList(firstVal){
                    var msgDiv = d.getElementById('msg');
                    try{
                        l = new List(firstVal);
                        msgDiv.className = 'success';
                        msgDiv.innerHTML = 'Lista criada com sucesso';
                    }catch(e){
                        msgDiv.className = 'error';
                        msgDiv.innerHTML = 'Não foi possível criar a lista';
                    }
                    _show(msgDiv);
                };

                API.insertVal = function insertVal(val){
                    var msgDiv = d.getElementById('msg');
                    try{
                        l.insert(val);
                        msgDiv.className = 'success';
                        msgDiv.innerHTML = 'Valor inserido com sucesso';
                    }catch(e){
                        msgDiv.className = 'error';
                        msgDiv.innerHTML = 'Não foi possível inserir o valor';
                    }
                    _show(msgDiv);
                };

                API.delList = function delList(){
                    var msgDiv = d.getElementById('msg');
                    try{
                        l.clear();
                        var listDiv = d.getElementById('list');
                        listDiv.innerHTML = '';
                        listDiv = null;
                        l = null;
                        msgDiv.className = 'success';
                        msgDiv.innerHTML = 'Lista removida com sucesso';
                    }catch(e){
                        msgDiv.className = 'error';
                        msgDiv.innerHTML = 'Não foi possível remover a lista';
                    }
                    _show(msgDiv);
                }

                API.removeVal = function rmVal(val){
                    var msgDiv = d.getElementById('msg');
                    if(l.isEmpty()){
                        msgDiv.className = 'warning';
                        msgDiv.innerHTML = 'Lista vazia';
                    }else{
                        var node = l.removeNode(val);
                        if(node){
                            msgDiv.className = 'success';
                            msgDiv.innerHTML = 'Valor removido com sucesso';
                        }else{
                            msgDiv.className = 'error';
                            msgDiv.innerHTML = 'Não foi possivel remover o valor';
                        }
                    }
                    _show(msgDiv);
                }

            })();

            window.onload = (function(){
                var cmdForm, formEl;

                return function(){
                    cmdForm = document.forms.commands;
                    formEl = cmdForm.elements;

                    cmdForm.onsubmit = function(e){
                        e = e || window.event;
                        if(typeof e.preventDefault == 'function')
                            e.preventDefault();
                        else
                            e.returnValue = false;

                        API.insertVal(this.elements.lValue.value);
                    };

                    formEl.lCreateDelete.onclick = function(){
                        if(this.value == 'c'){
                            API.createList();
                            this.value = 'd';
                            this.innerHTML = 'Deletar lista';
                        }else{
                            API.delList();
                            this.value = 'c';
                            this.innerHTML = 'Criar lista';
                        }
                    };

                    formEl.lRemove.onclick = function(){
                        API.removeVal(this.form.elements.lValue.value);
                    }

                    cmdForm = formEl = null;
                };
            })();
        </script>
    </head>
    <body>
        <form name='commands'>
            <p>
                <button name='lCreateDelete' value='c' type='button'>Criar lista</button>
            </p>
            <p>
                <input type="text" name="lValue">
                <button name='lInsert' value='i' type='submit'>Inserir valor</button>
                <button name='lRemove' value='r'>Remover valor</button>
            </p>
        </form>
        <form name='ulScript' action='process.php' method='post' enctype='multipart/form-data'>
            <input type='file' name='scriptFile'>
            <input type='submit' value='Vai!'>
        </form>
        <div id="list">
        </div>
        <div id='msg' style="display:none">
        </div>
    </body>
</html>