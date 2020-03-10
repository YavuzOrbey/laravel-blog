const particles = [];
const particlesLength = 10;
let hourglass;
let frames = 60;
function setup() {
    createCanvas(600, 800);
    hourglass = new Hourglass();
    let counter = 0;
    frameRate(frames);
    //instead of choosing x and y coordinates the container itself needs to pack the particles inside
    const interval = setInterval(() => {
        particles.push(
            new Particle(
                undefined,
                createVector(0, Math.floor(random(1, 2))),
                4,
                1,
                false,
                hourglass
            )
        );
        counter++;
        if (counter >= particlesLength) {
            clearInterval(interval);
        }
    }, 500);
}

function draw() {
    background("#fff");
    particles.forEach((p, i) => {
        p.draw();
        p.update();
        p.checkParticles(particles.slice(i));
    });
    hourglass.draw();
}

class Particle {
    constructor(
        acceleration = createVector(0, 9.8),
        velocity = createVector(random(-2, 2), random(-2, 2)),
        size = 10,
        transparency = 0.5,
        fading = true,
        shape
    ) {
        this.pos = createVector(
            shape.x + (Particle.number % shape.width),
            shape.y + 1
        );
        //velocity
        this.velocity = velocity;
        this.acceleration = acceleration;
        //size
        this.size = size;
        this.fading = fading;
        this.transparency = transparency;
        this.shape = shape;
        Particle.number++;
    }
    draw() {
        fill(`rgba(0,0,0,${this.transparency})`);
        circle(this.pos.x, this.pos.y, this.size);
    }

    update() {
        // if move would take the particle outside of the objects area make sure to move a pixel before that line
        debugger;
        if (this.velocity.y != 0) {
            this.velocity.y +=
                this.acceleration.y * (1 / frames) * (1 / frames);
        }
        this.pos.add(this.velocity);
        if (this.pos.x >= this.shape.x + this.shape.width) {
            this.velocity.x = 0;
            this.pos.x = this.shape.x - 1;
        }
        if (this.pos.y >= this.shape.y + this.shape.length) {
            this.velocity.y = 0;
            this.pos.y = this.shape.y + this.shape.length - 1;
        }
        /* if (this.fading) {
            this.transparency -= 0.001;
        } else if (!this.fading) {
            this.transparency += 0.001;
        }
        if (this.transparency < 0) {
            this.fading = false;
        } else if (this.transparency > 1) {
            this.fading = true;
        } */
    }
    setVelocity(velocity) {
        this.velocity = velocity;
    }

    checkParticles(particles) {
        particles.forEach(p => {
            const distance = dist(this.pos.x, this.pos.y, p.pos.x, p.pos.y);
            if (distance.y == 0) {
                this.velocity = createVector(0, 0);
            }
        });
    }
}
Particle.number = 1;
class Hourglass {
    constructor() {
        this.x = 20;
        this.y = 20;
        this.length = 700;
        this.width = 100;
    }
    draw() {
        noFill();
        strokeWeight(1);
        strokeJoin(MITER);
        beginShape();
        vertex(this.x, this.y);
        vertex(this.x + this.width, this.y);
        vertex(this.x + this.width, this.y + this.length);
        vertex(this.x, this.y + this.length);
        vertex(this.x, this.y);
        endShape();
    }
}
