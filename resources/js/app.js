import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.querySelectorAll('.hover-trigger').forEach(div => {
    const img = div.querySelector('.hover-gif');
    const png = img.dataset.png;
    const gif = img.dataset.gif;

    let isHovering = false;

    div.addEventListener('mouseenter', () => {
        isHovering = true;
        img.src = gif;
    });

    div.addEventListener('mouseleave', () => {
        isHovering = false;
        const gifDuration = 1000;
        setTimeout(() => {
            if (!isHovering) {
                img.src = png;
            }
        }, gifDuration);
    });
});

document.querySelectorAll('.hover-trigger').forEach(div => {
    div.addEventListener('click', () => {
        const route = div.dataset.route;
        if (route) {
            window.location.href = route;
        }
    });
});

const prompts = [
    "Astronaut Riding A Horse",
    "Futuristic City at Sunset",
    "A Dragon Flying Over Mountains",
    "Robot Playing Chess with Human",
    "Mysterious Forest with Glowing Lights",
    "Underwater City with Floating Islands",
    "Cyberpunk Street with Neon Lights",
    "A Cat in Space Suit",
    "Pirate Ship Sailing Through a Storm",
    "Fantasy Castle on a Cloud"
];

let currentPromptIndex = 0;
const textarea = document.getElementById('prompt');

function changePlaceholder() {
    textarea.placeholder = prompts[currentPromptIndex];
    currentPromptIndex = (currentPromptIndex + 1) % prompts.length;

    // Reset animation by removing and adding the class to trigger re-animation
    textarea.classList.remove('typing');
    void textarea.offsetWidth; // Trigger reflow
    textarea.classList.add('typing');
}

// Change the placeholder text every 5 seconds
setInterval(changePlaceholder, 5000);

// Initial call to start with the first prompt
changePlaceholder();

