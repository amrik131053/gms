<!DOCTYPE html>
<html>
<head>
    <title>YouTube Video Tag Suggestions</title>
    <style>
        #suggestions {
            display: none;
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
        }

        #suggestions ul {
            list-style: none;
            padding: 0;
        }

        #suggestions li {
            padding: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <textarea id="video-description" placeholder="Write your video description"></textarea>
    <div id="suggestions">
        <ul id="tag-suggestions">
            <li>Tag 1</li>
            <li>Tag 2</li>
            <li>Tag 3</li>
        </ul>
    </div>
    <script>
        const textarea = document.getElementById('video-description');
        const suggestions = document.getElementById('suggestions');
        const tagSuggestions = document.getElementById('tag-suggestions');
        
        // Define some sample tag suggestions.
        const sampleTags = ["Approved", "Recomend", "Tag 3", "Tag 4", "Tag 5"];

        textarea.addEventListener('input', function () {
            const inputText = textarea.value.toLowerCase();
            const matchingTags = sampleTags.filter(tag => tag.toLowerCase().includes(inputText));

            // Clear existing suggestions.
            tagSuggestions.innerHTML = '';

            if (matchingTags.length > 0) {
                matchingTags.forEach(tag => {
                    const suggestionItem = document.createElement('li');
                    suggestionItem.textContent = tag;
                    suggestionItem.addEventListener('click', function () {
                        // When a suggestion is clicked, add it to the textarea.
                        textarea.value = textarea.value.replace(inputText, tag);
                        suggestions.style.display = 'none';
                    });
                    tagSuggestions.appendChild(suggestionItem);
                });

                suggestions.style.display = 'block';
            } else {
                suggestions.style.display = 'none';
            }
        });
    </script>
</body>
</html>
