var app = require('http').createServer()
var io = require('socket.io')(app);
var Redis = require('ioredis');
var redis = new Redis();


app.listen(3009);

redis.subscribe('updated-profile', function (err, count) {
    console.log('done');
});

redis.subscribe('server.created', function (err, count) {
    console.log('done');
});

redis.on('server.created', function (channel, message) {
    console.log(channel, message);

});

console.log('start')

io.on('connection', function (socket) {
    socket.emit('news', { hello: 'world' });
    socket.on('my other event', function (data) {
        console.log(data);
    });
});