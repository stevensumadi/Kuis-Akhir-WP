let user = null;
let users = [];

let turn = '';
let board = [];
let socket = io('http://localhost:3000', [{
    transports: ['websocket'],
}]);

socket.on('connect', () => {
    // Code to handle socket connection
    // For example, you can display a message that the connection is established.
    document.getElementById('message').innerHTML = 'Connected';
});

socket.on('roomFull', () => {
    // Code to handle the event when the room is full.
    document.getElementById('message').innerHTML = 'Room is full';
});

socket.on('setUser', (data) => {
    // Code to handle when the user's information is set.
    user = data;
});

socket.on('start', (data) => {
    // Code to handle when the game starts.
    users = data.users;
    turn = data.turn;
    board = data.board;
    renderBoard();

    if(users.length === 1){
        document.getElementById('message').innerHTML = 'Wait for another player to join ...';
        // document.getElementById('board').classList.add('hidden');
    } else {
        document.getElementById('message').innerHTML = 'You are ' + user.symbol + ' and you play as player' + user.number + '';
    }
});

socket.on('turn', (data) => {
    // Code to handle when it's a player's turn.
    turn = data.turn;

    if(data.users.length === 1){
        document.getElementById('message').innerHTML = 'Waiting for another player to join ...';
        // document.getElementById('board').classList.add('hidden');
    } else if (data.users.length === 2) {
        document.getElementById('message').innerHTML = 'You are ' + user.symbol + ', it is ' + turn + ' turn';
        // document.getElementById('board').classList.remove('hidden');
    }
});

socket.on('move', (data) => {
    // Code to handle when a move is made.
    turn = data.turn;
    board = data.board;
    renderBoard();
});

socket.on('winner', (data) => {
    // Code to handle when there's a winner.
    document.getElementById('message').innerHTML = data + ' won';
    turn = '';
});

socket.on('waiting', () =>{
    // Code to handle when waiting for another player to join.
    console.log('waiting');
    // hide board

});

socket.on('resetGame', (user) => {
    // Code to handle when the game needs to be reset (e.g., one user leaves).
    users = [user];
    turn = 'X';
    board = ['', '', '', '', '', '', '', '', ''];
    renderBoard();
    document.getElementById('message').innerHTML = 'Game reset! You are ' + user.symbol + ' it is X turn ';
});

socket.on('disconnect', () => {
    // Code to handle disconnection.
    document.getElementById('message').innerHTML = 'Disconnected';
});

document.getElementById('join-btn').addEventListener('click', () => {
    document.getElementById('join-btn').disabled = true;
    // Code to handle the "Join" button click.
    // Get the value of the button (room ID) from the HTML.
    const roomId = document.getElementById('room').value;
    joinRoom(roomId);
});

// Function to join a room
function joinRoom(roomId) {
    if (!roomId) {
        document.getElementById('message').innerHTML = 'Invalid Room ID';
        document.getElementById('join-btn').disabled = false;
        return;
    }

    socket.emit('joinRoom', roomId);
}

function renderBoard() {
    let boardDiv = document.getElementById('board');
    let boardHTML = '';
    for (let i = 0; i < board.length; i++) {
        boardHTML += `
        <div onclick="handleClick(${i})" class="col border border-5 border-secondary p-5 ${board[i] === 'O' ? 'bg-primary' : board[i] === 'X' ? 'bg-danger' : 'bg-dark'}">
            <h2 class="text-center text-white">${board[i]}</h2>
        </div>`;
    }
    boardDiv.innerHTML = boardHTML;
}

function handleClick (i) {
    if (!turn) {
        return;
    }
    
    if (board[i] === '' && turn === user.symbol) {
        board[i] = user.symbol;
        socket.emit('move', {
            turn: turn,
            board: board,
            i: i
        });
    }
}

window.onload = function () {
    renderBoard();
};