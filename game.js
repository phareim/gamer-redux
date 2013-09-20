var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');
var counter = document.getElementById('counter');
canvas.width = document.getElementsByTagName('body')[0].clientWidth - 40;
canvas.height = window.innerHeight - 120;

function randomColor(){
    return "hsl(" + (Math.round(Math.random() * 360)) +
            "," + (Math.round(Math.random() * 100)) +
            "%," + (Math.round(Math.random() * 100)) +
            "%)";
}

var mySprite = new_cherry();
mySprite.width = 10;
mySprite.height = 10;
mySprite.speed = 300;
mySprite.tic = function() {
    return this
};

var cherries = [];

var i = 0;
var boxCount = 200;//100 +( Math.round(Math.random()*900) );
while (i <= boxCount) {
    cherries[i] = new_cherry();
    i++;
}
function move(direction, _speed,x){
    direction ? x += _speed * 1000 : x -= _speed * 1000;
    return x;

}

function new_cherry() {
    return {
        x: Math.round(((Math.random() * document.getElementsByTagName('body')[0].clientWidth)) / 6)
            + document.getElementsByTagName('body')[0].clientWidth / 4,
        y: Math.round(((Math.random() * window.innerHeight) / 6)) + window.innerHeight / 4,
        width: 10,
        height: 10,
        color: '#123456',
        speed: Math.random()*300,
      _speed: {x:Math.random()*400,y:Math.random()*400},
        direction:
        {
            up: Math.random() > 0.5 ? true : false,
            right: Math.random() > 0.5 ? true : false
        },
        tic: function(mod)
        {
            this.direction.right ? this.x += this._speed.x * mod : this.x -= this._speed.x * mod;
            this.direction.up ? this.y += this._speed.y * mod : this.y -= this._speed.y * mod;

          //this.x = move(this.direction.x,this._speed.x,this.x);
          //this.y = move(this.direction.y,this._speed.y,this.y);
            return this;
        },

        changeDirection: function() {
            if (this.x <= 0) {
                this.direction.right = true;
            }
            if (this.x >= canvas.width - (this.width)) {
                this.direction.right = false;
            }
            if (this.y <= 0) {
                this.color = 'white';
                this.direction.up = true;
            }
            if (this.y >= canvas.height - (this.height)) {
                this.color='black';
                this.direction.up = false;
            }
            return this;
        },
        hitTest: function() {
            if (this !== mySprite && hitTest(this, mySprite)) {
                this.color = mySprite.color;
            }
            return this;
        }
    };
}

function hitTest(r1, r2) {
    if (inXaxis(r1, r2) && inYaxis(r1, r2)) {
        return true;
    } else {
        return false;
    }
}

function inXaxis(r1, r2) {
    return ((r1.x + r1.width >= r2.x) && (r1.x <= r2.x + r2.width));
}

function inYaxis(r1, r2) {
    return ((r1.y + r1.height >= r2.y) && (r1.y <= r2.y + r2.height));
}

var keysDown = {};

window.addEventListener('keydown', function(e) {
    keysDown[e.keyCode] = true;
});

window.addEventListener('keyup', function(e) {
    console.log("moved " + e.keyCode);
    delete keysDown[e.keyCode];
});

function update(mod) {
    if (37 in keysDown && mySprite.x > 0) {
        mySprite.x -= mySprite.speed * mod;

    }
    if (38 in keysDown && mySprite.y > 0) {
        mySprite.y -= mySprite.speed * mod;

    }
    if (39 in keysDown && mySprite.x < (canvas.width - (mySprite.width))) {
        mySprite.x += mySprite.speed * mod;
    }
    if (40 in keysDown && mySprite.y < (canvas.height - (mySprite.height))) {
        mySprite.y += mySprite.speed * mod;
    }
}

function render() {
    canvas.height = canvas.height; // this resets the canvas.
    ctx.fillStyle = 'rgba(0,0,0,0)'; // only the alpha really matters
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    cherries.forEach(function(a, b, c) {
        ctx.fillStyle = a.color;
        ctx.fillRect(a.x, a.y, a.width, a.height);
    });

    ctx.fillStyle = mySprite.color;
    ctx.fillRect(mySprite.x, mySprite.y, mySprite.width, mySprite.height);
}

function run() {
    update((Date.now() - time) / 1000);

    cherries.forEach(function(a, b, c) {
        a.changeDirection().tic((Date.now() - time) / 1000).hitTest();
        var filtered;
        /*= c.filter(c){hitTest(a,c)};
        /*.forEach(function(d,e,f){
            var tmp_color = a.color;
            a.color = d.color;
            d.color = tmp_color;
        });*/
        /*cherries.forEach(function(d, e, f){
                if (hitTest(a,d) && a.color != d.color ){
                    if(Math.random > 0.5 )
                    {
                        d.color = a.color;
                        d.height--;
                        d.width--;
                        a.height++;
                        a.width++;
                    }
                    else
                    {
                        a.color = d.color;
                        a.height--;
                        a.width--;
                        d.height++;
                        d.width++;
                    }
                }
        });*/
    });
    render();
    time = Date.now();
}

var time = Date.now();
setInterval(run, 10);
