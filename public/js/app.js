document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.favorite').forEach((button) => {
        button.addEventListener('click', () => {
            const current = button.textContent.trim();
            button.textContent = current === '♡' ? '♥' : '♡';
            button.style.color = current === '♡' ? '#d12f2f' : '#1f2937';
        });
    });
});