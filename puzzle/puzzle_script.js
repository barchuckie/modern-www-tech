const PUZZLE_HOVER_TINT = '#d8d8d8';
const RED_PUZZLE = '#990000';
var columns = 4;
var rows = 4;
var _canvas;
var _stage; /* kontekst 2D */
var _img; /* załadowany obrazek */
var _pieces; /* tablica współ. dla kawałków */
var _puzzleWidth; /* szerokość układanki */
var _puzzleHeight; /* wysokość układanki */
var _pieceWidth; /* szerokość puzzla */
var _pieceHeight; /* wysokość puzzla */
var _redPiece; /* puzzle na jaki upuszczamy */
var _mouse; /* x,y - pozycja wskaźnika myszy */

function init() {
    _img = new Image();
    loadImage(_img, "resources/nintendo.png")
        .then(onImage)
        .catch(console.error);
}

function newGame(img) {
    _canvas.onmousedown = null;
    _canvas.onmousemove = null;
    loadImage(_img, img)
        .then(onImage)
        .catch(console.error);
}

function onImage() {
    columns = document.getElementById('columns').value;
    rows = document.getElementById('rows').value;
    _pieceWidth = Math.floor(_img.width / columns);
    _pieceHeight = Math.floor(_img.height / rows);
    _puzzleWidth = _pieceWidth * columns;
    _puzzleHeight = _pieceHeight * rows;
    setCanvas();
    initPuzzle();
}

function setCanvas() {
    _canvas = document.getElementById('canvas');
    _stage = _canvas.getContext('2d');
    _canvas.width = _puzzleWidth;
    _canvas.height = _puzzleHeight;
    _canvas.style.border = "1px solid black";
}

function initPuzzle() {
    _pieces = [];
    _mouse = { x:0, y:0 };
    _redPiece = null;
    _stage.drawImage(_img, 0, 0, _puzzleWidth, _puzzleHeight,
        0, 0, _puzzleWidth, _puzzleHeight);
    createTitle("Click to Start Puzzle");
    buildPieces();
}

function createTitle(msg){
    _stage.fillStyle = "#000000";
    _stage.globalAlpha = .4;
    _stage.fillRect(100,_puzzleHeight - 40,_puzzleWidth - 200,40);
    _stage.fillStyle = "#FFFFFF";
    _stage.globalAlpha = 1;
    _stage.textAlign = "center";
    _stage.textBaseline = "middle";
    _stage.font = "20px Arial";
    _stage.fillText(msg,_puzzleWidth / 2,_puzzleHeight - 20);
}

function buildPieces(){
    var i;
    var piece;
    var xPos = 0;
    var yPos = 0;
    for(i = 0; i < columns * rows; i++){
        piece = {};
        piece.sx = xPos;
        piece.sy = yPos;
        _pieces.push(piece);
        xPos += _pieceWidth;
        if(xPos >= _puzzleWidth){
            xPos = 0;
            yPos += _pieceHeight;
        }
    }
    _canvas.onmousedown = shufflePuzzle;
}

function shufflePuzzle(){
    _pieces = shuffleArray(_pieces);
    _stage.clearRect(0,0,_puzzleWidth,_puzzleHeight);
    var i;
    var piece;
    var xPos = 0;
    var yPos = 0;
    for(i = 0;i < _pieces.length;i++){
        piece = _pieces[i];
        piece.xPos = xPos;
        piece.yPos = yPos;
        piece.redFlag = false;
        if (i === 0) {
            _redPiece = piece;
            _stage.fillStyle = RED_PUZZLE;
            _stage.fillRect(piece.xPos, piece.yPos, _pieceWidth, _pieceHeight);
        } else {
            _stage.drawImage(_img, piece.sx, piece.sy, _pieceWidth, _pieceHeight, xPos, yPos, _pieceWidth, _pieceHeight);
        }
        _stage.strokeRect(xPos, yPos, _pieceWidth,_pieceHeight);
        xPos += _pieceWidth;
        if(xPos >= _puzzleWidth){
            xPos = 0;
            yPos += _pieceHeight;
        }
    }
    redFlagPieces();
    _canvas.onmousedown = onPuzzleClick;
    _canvas.onmousemove = highlightPuzzle;
}

function highlightPuzzle(e) {
    setMouseCoordinates(e);
    _stage.clearRect(0,0,_puzzleWidth,_puzzleHeight);
    var i;
    var piece;
    for(i = 0; i < _pieces.length; i++){
        piece = _pieces[i];
        if(piece === _redPiece) {
            _stage.save();
            _stage.globalAlpha = 1;
            _stage.fillStyle = RED_PUZZLE;
            _stage.fillRect(piece.xPos, piece.yPos, _pieceWidth, _pieceHeight);
            _stage.restore();
            continue;
        }
        _stage.drawImage(_img, piece.sx, piece.sy,
            _pieceWidth, _pieceHeight, piece.xPos, piece.yPos,
            _pieceWidth, _pieceHeight);
        _stage.strokeRect(piece.xPos, piece.yPos, _pieceWidth,
            _pieceHeight);
        if(_mouse.x < piece.xPos || _mouse.x > (piece.xPos + _pieceWidth) || _mouse.y < piece.yPos
            || _mouse.y > (piece.yPos + _pieceHeight)) {
            //NOT OVER
        } else if (piece.redFlag) {
            _stage.save();
            _stage.globalAlpha = .4;
            _stage.fillStyle = PUZZLE_HOVER_TINT;
            _stage.fillRect(piece.xPos, piece.yPos, _pieceWidth, _pieceHeight);
            _stage.restore();
        }
    }
}

function redFlagPieces() {
    var i;
    for(i = 0; i < _pieces.length; i++) {
        const piece = _pieces[i];
        if ((piece.xPos === _redPiece.xPos - _pieceWidth || piece.xPos === _redPiece.xPos + _pieceWidth)
            && (piece.yPos === _redPiece.yPos)) {
            piece.redFlag = true;
        } else if ((piece.yPos === _redPiece.yPos - _pieceHeight || piece.yPos === _redPiece.yPos + _pieceHeight)
            && (piece.xPos === _redPiece.xPos)) {
            piece.redFlag = true;
        } else {
            piece.redFlag = false;
        }
    }
}

function setMouseCoordinates(event) {
    if(event.layerX || event.layerX === 0) {
        _mouse.x = event.layerX; // - _canvas.offsetLeft;
        _mouse.y = event.layerY; // - _canvas.offsetTop;
    } else if(event.offsetX || event.offsetX === 0) {
        _mouse.x = event.offsetX; // - _canvas.offsetLeft;
        _mouse.y = event.offsetY; // - _canvas.offsetTop;
    }
}

function onPuzzleClick(e){
    setMouseCoordinates(e);
    const currentPiece = checkPieceClicked();
    if(currentPiece != null) {
        var tmp = {xPos:currentPiece.xPos, yPos:currentPiece.yPos};
        currentPiece.xPos = _redPiece.xPos;
        currentPiece.yPos = _redPiece.yPos;
        _redPiece.xPos = tmp.xPos;
        _redPiece.yPos = tmp.yPos;
        redFlagPieces();
        resetPuzzleAndCheckWin();
    }
}

function checkPieceClicked(){
    var i;
    var piece;
    for(i = 0; i < _pieces.length; i++){
        piece = _pieces[i];
        if(_mouse.x < piece.xPos || _mouse.x > (piece.xPos + _pieceWidth) || _mouse.y < piece.yPos || _mouse.y > (piece.yPos + _pieceHeight)) {
            //PIECE NOT HIT
        } else {
            if (piece.redFlag) {
                return piece;
            }
        }
    }
    return null;
}

function resetPuzzleAndCheckWin() {
    _stage.clearRect(0,0, _puzzleWidth, _puzzleHeight);
    var gameWin = true;
    var i;
    var piece;
    for(i = 0; i < _pieces.length;i++) {
        piece = _pieces[i];
        if (piece === _redPiece) {
            _stage.fillStyle = RED_PUZZLE;
            _stage.fillRect(piece.xPos, piece.yPos, _pieceWidth, _pieceHeight);
        } else {
            _stage.drawImage(_img, piece.sx, piece.sy, _pieceWidth, _pieceHeight, piece.xPos, piece.yPos,
                _pieceWidth, _pieceHeight);
        }
        _stage.strokeRect(piece.xPos, piece.yPos, _pieceWidth, _pieceHeight);
        if(piece.xPos !== piece.sx || piece.yPos !== piece.sy){
            gameWin = false;
        }
    }
    if(gameWin) {
        setTimeout(gameOver,500);
    }
}

function gameOver() {
    _canvas.onmousedown = null;
    _canvas.onmousemove = null;
    onImage();
}

function shuffleArray(array) {
    var i;
    for(i = array.length - 1; i > 0; i--){
        const j = Math.floor(Math.random() * i);
        const temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array
}

const loadImage = (image, src, size) =>
    new Promise((resolve, reject) => {
        if (size) {
            image.style.height = size;
            image.style.width = 'auto';
        }
        image.addEventListener("load", resolve);
        image.addEventListener("error", reject);
        image.src = src;
    });