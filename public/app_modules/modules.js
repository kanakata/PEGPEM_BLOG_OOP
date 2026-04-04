export function typeWriter(tag, content, time) {
    const Writer = setInterval(() => {
      chr++;
      tag.textContent = content.slice(0, chr);

      // Stop the timer when we reach the end of the string
      if (chr >= D.length) {
        clearInterval(Writer);
      }
    }, time);
}