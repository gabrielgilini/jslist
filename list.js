function List(firstValue){
    var _first;

    if(typeof firstValue != 'undefined'){
        _first = new Node(firstValue);
    }

    function insertBeginning(newValue){
        var tmp = _first;
        _first = new Node(newValue);
        _first.setNext(tmp);
        tmp = null;
    }

    function insertAfter(node, newValue){
        var tmp = node.getNext(),
            newNode = new Node(newValue);
        node.setNext(newNode);
        newNode.setNext(tmp);
        tmp = newNode = null;
    }

    function clearList(){
        var toDel = _first,
            tmp;
        while(tmp = toDel.getNext()){
            toDel.delNext();
            toDel = tmp;
        }
        _first = null;
    }

    function _getLastNode(){
        var node = _first;
        while(typeof node.getNext() != 'undefined')
            node = node.getNext();
        return node;
    }

    function getListArray(){
        if(!_first)
            return [];

        var arr = [_first.getVal()],
            tmpNode = _first;

        while(tmpNode = tmpNode.getNext()){
            arr.push(tmpNode.getVal());
        }

        return arr;

    }

    function getNode(val){
        var tmp = _first;
        do{
            if(tmp && tmp.getVal() === val)
                return tmp;
        }while(tmp = tmp.getNext());
        return null;
    }

    return {
        'insert': function(){
            if(arguments.length == 2){
                insertAfter(arguments[0], arguments[1]);
            }
            else{
                insertBeginning(arguments[0]);
            }
        },
        'clear': clearList,
        'getListArray': getListArray,
        'getNode': getNode
    };
}

function Node(val){
    if(typeof val == 'undefined'){
        throw new Exception('EmptyNode', 'Cannot construct a node with an undefined value');
        return;
    }
    var _val = val,
        _next;

    function get(){
        return _val;
    }

    function set(newVal){
        _val = newVal;
        return _val;
    }

    function getNext(){
        return _next;
    }

    function setNext(node){
        if(typeof node.typeOf == 'function' && node.typeOf() == 'node')
            _next = node;
        else
            throw new Exception('TypeError', 'The parameter must be of type `Node`')
    }

    function delNext(){
        _next = null;
    }

    return {
        'setVal': set,
        'getVal': get,
        'getNext': getNext,
        'setNext': setNext,
        'delNext': delNext,
        'typeOf': function(){ return 'node'; }
    };
}

function Exception(name, message){
    return {
        'name': name,
        'message': message
    }
}