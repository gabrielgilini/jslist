function List(firstValue){
    var _first;

    if(typeof firstValue != 'undefined'){
        _first = new Node(firstValue);
    }

    function insertBeginning(newValue){
        var tmp = _first, empty = isEmpty();
        _first = new Node(newValue);
        if(!empty) _first.setNext(tmp);
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
        if(!isEmpty()){
            var toDel = _first,
                tmp;
            while(tmp = toDel.getNext()){
                toDel.delNext();
                toDel = tmp;
            }
            _first = null;
        }
    }

    function _getLastNode(){
        var node = _first;
        while(typeof node.getNext() != 'undefined')
            node = node.getNext();
        return node;
    }

    function getValuesArray(){
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
        var node = _first;
        do{
            if(node && node.getVal() === val)
                return node;
        }while(node = node.getNext());
        return null;
    }

    function _getNodeBefore(val){
        var thisNode = _first,
            nextNode;
        do{
            if(thisNode){
                nextNode = thisNode.getNext();
                if(nextNode && nextNode.getVal() === val)
                    return thisNode;

            }
        }while(thisNode = nextNode);
        return null;
    }

    function removeNode(val){
        var nodeBefore,
            toDel;

        if(_first.getVal() === val){
            toDel = _first;
            _first = toDel.getNext();
            toDel.delNext();
            return toDel;
        }else if(nodeBefore = _getNodeBefore(val)){
            toDel = nodeBefore.getNext();
            if(toDel.getNext()){
                nodeBefore.setNext(toDel.getNext());
            }else{
                nodeBefore.delNext();
            }
            toDel.delNext();
            return toDel;
        }
        return false;
    }

    function isEmpty(){
        return !_first;
    }

    return {
        'insert': function(){
            if(arguments.length === 0){
                throw new Exception('TypeError', 'Node value can\'t be undefined');
            }
            else if(arguments.length === 2 && arguments[1]){
                insertAfter(arguments[0], arguments[1]);
            }
            else{
                insertBeginning(arguments[0]);
            }
        },
        'clear': clearList,
        'getValuesArray': getValuesArray,
        'getNode': getNode,
        'removeNode': removeNode,
        'isEmpty': isEmpty
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
        if(node && typeof node.typeOf == 'function' && node.typeOf() == 'node')
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