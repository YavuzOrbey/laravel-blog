const particles = [];
const particlesLength = Math.floor(window.innerWidth / 10);
function setup() {
    createCanvas(window.innerWidth, window.innerHeight);

    for (let i = 0; i < particlesLength; i++) {
        particles.push(new Particle());
    }
}

function draw() {
    background("#fff");
    particles.forEach((p, i) => {
        p.draw();
        p.update();
        p.checkParticles(particles.slice(i));
    });
}

class Particle {
    transparency = 0.5;
    fading = true;
    constructor() {
        // position
        this.pos = createVector(random(width), random(height));

        //velocity
        this.velocity = createVector(random(-2, 2), random(-2, 2));

        //size
        this.size = 10;
    }

    draw() {
        noStroke();
        fill(`rgba(70,70,70,${this.transparency})`);
        rect(this.pos.x, this.pos.y, 5, 5);
    }

    update() {
        this.pos.add(this.velocity);
        if (this.fading) {
            this.transparency -= 0.001;
        } else if (!this.fading) {
            this.transparency += 0.001;
        }
        if (this.transparency < 0) {
            this.fading = false;
        } else if (this.transparency > 1) {
            this.fading = true;
        }
        this.edges();
    }

    //detect edges
    edges() {
        if (this.pos.x < 0 || this.pos.x > width) {
            this.velocity.x *= -1;
        }
        if (this.pos.y < 0 || this.pos.y > height) {
            this.velocity.y *= -1;
        }
    }

    checkParticles(particles) {
        particles.forEach(p => {
            const distance = dist(this.pos.x, this.pos.y, p.pos.x, p.pos.y);
            if (distance < 120) {
                stroke("rgba(75,75,75,.06)");
                line(this.pos.x, this.pos.y, p.pos.x, p.pos.y);
            }
        });
    }
}
