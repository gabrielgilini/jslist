<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>List test</title>
        <script type="text/javascript" src="list.js"></script>
        <script type="text/javascript">
            function appendText(string, father){
                var pE = document.createElement('p');
                var tN = document.createTextNode(string);

                pE.appendChild(tN);
                father.appendChild(pE);
            }

            (function(){
                var l = new List('foo');
                l.insert('bar');
                console.log(l.getListArray(), l.getNode('foo'));
                l.clear();
                console.log(l.getListArray());
            })();
        </script>
    </head>
    <body>
        <div id="results">
        </div>
    </body>
</html>