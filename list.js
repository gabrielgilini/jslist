function List(firstValue){
    var _first;

    if(typeof firstValue != 'undefined'){
        _first = new Node(firstValue);
    }

    function insertBeginning(newValue){
        var tmp = _first;
        _first = new Node(newValue);
        _first.next = tmp;
        tmp = null;
    }

    function insertAfter(node, newValue){
        var tmp = node.next;
        node.next = new Node(newValue);
        node.next.next = tmp;
        tmp = null;
    }

    function clearList(){
        var tmp;
        while(tmp = _getLastNode()){
            delete node.next;
        }
    }

    function _getLastNode(){
        var node;
        while(node = node.next);
        return node;
    }

    function getListArray(){
        var arr = [_first.get()],
            tmpNode = _first;

        while(tmpNode = tmpNode.next){
            arr.push(tmpNode.get());
        }

        return arr;

    }

    function getNode(val){
        var tmp = _first;
        do{
            if(tmp.get() === val)
                return tmp;
        }while(tmp = tmp.next);
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
        throw new Exception('EmptyNode', 'Cannot construct a node with an undefined value.');
        return;
    }
    var _val = val,
        next;

    function get(){
        return _val;
    }

    function set(newVal){
        _val = newVal;
        return _val;
    }

    function getNext(){
        return next;
    }

    function setNext(node){
        next = node;
    }

    return {
        'setVal': set,
        'getVal': get,
        'getNext': getNext,
        'setNext': setNext
    };
}

function Exception(name, message){
    return {
        'name': name,
        'message': message
    }
}