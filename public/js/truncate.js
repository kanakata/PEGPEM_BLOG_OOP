(function truncateTitles() {
  const titleElements = document.querySelectorAll('#title');
  const maxLength = 40;
  const replacement = '.....';

  titleElements.forEach((element) => {
    const originalText = element.textContent.trim();

    if (originalText.length > maxLength) {
      const truncationPoint = maxLength - replacement.length;
      const truncatedText =
        originalText.substring(0, truncationPoint) + replacement;
      element.textContent = truncatedText;
    }
  });
})();

(function truncateContent() {
  // 1. Select all elements whose ID starts with "title"
  const contentElements = document.querySelectorAll('#content');

  // Define the maximum length and the replacement string
  const maxLength = 100;
  const replacement = '.....';

  contentElements.forEach((element) => {
    // Get the current text content of the element
    const originalText = element.textContent.trim();

    if (originalText.length > maxLength) {
      // 2. Truncate the string to (maxLength - replacement.length)
      // We subtract the replacement length so the resulting string + '.....'
      // is still very close to the 30 character limit.
      const truncationPoint = maxLength - replacement.length;

      // 3. Create the new truncated string
      const truncatedText =
        originalText.substring(0, truncationPoint) + replacement;

      // 4. Update the element's content
      element.textContent = truncatedText;
    }
  });
})();