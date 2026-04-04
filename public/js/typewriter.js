function displayText() {
  // 1. Get the raw string from the hidden element
  let raw_data = document.getElementById('blog_data').textContent;

  // 2. Parse it into an object
  let parsed_data = JSON.parse(raw_data);

  // 3. Select your display targets
  let author = document.getElementById('author');
  let title = document.getElementById('title');
  let desc = document.getElementById('description');
  const AUTHOR_CONTENT = 'author:  ' + parsed_data['author'];
  const TITLE_CONTENT = "Title: " + parsed_data['title'];
  const DESC_CONTENT = "Description: " + parsed_data['description'];

  // 4. Initialize the counter
  let chr = 0;

  // 5. Start the interval
  const authortyper = setInterval(() => {
    chr++;
    author.textContent = AUTHOR_CONTENT.slice(0, chr);

    // 6. Check against the length of the string
    if (chr >= AUTHOR_CONTENT.length) {
      chr = 0;
      clearInterval(authortyper);
      const titletyper = setInterval(() => {
        chr++;
        title.textContent = TITLE_CONTENT.slice(0, chr);

        // 6. Check against the length of the string
        if (chr >= TITLE_CONTENT.length) {
          chr = 0;
          clearInterval(titletyper);
          const desctyper = setInterval(() => {
            chr++;
            desc.textContent = DESC_CONTENT.slice(0, chr);

            // 6. Check against the length of the string
            if (chr >= DESC_CONTENT.length) {
              clearInterval(desctyper);
            }
          }, 50);
        }
      }, 50);
    }
  }, 50);
}

// Run the function after the DOM is fully loaded
window.addEventListener('DOMContentLoaded', displayText);
