const GITHUB_TOKEN = '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'; // Keep secure!
const OWNER = 'akomsowanapsu';
const REPO = 'foodshop';
const FILE_PATH = 'order.txt'; // Saves directly to the main folder

async function saveToGitHub() {
    const isChecked = document.getElementById('myCheckbox').checked;
    const content = `Checkbox value: ${isChecked}`;
    
    // Base64 encode content (required by GitHub API)
    const encodedContent = btoa(content); 
    const url = `https://github.com{OWNER}/${REPO}/contents/${FILE_PATH}`;

    let sha = "";

    // Step 1: Check if file already exists to retrieve its SHA
    try {
        const response = await fetch(url, {
            headers: { 'Authorization': `token ${GITHUB_TOKEN}` }
        });
        if (response.ok) {
            const data = await response.json();
            sha = data.sha; // Required if updating an existing file
        }
    } catch (error) {
        console.log("File does not exist yet. Creating a new one.");
    }

    // Step 2: Push the new value to GitHub
    const body = {
        message: `Update checkbox status to ${isChecked}`,
        content: encodedContent,
    };
    if (sha) body.sha = sha; // Include SHA if updating

    const saveResponse = await fetch(url, {
        method: 'PUT',
        headers: {
            'Authorization': `token ${GITHUB_TOKEN}`,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(body)
    });

    if (saveResponse.ok) {
        alert('Value successfully saved to GitHub main folder!');
    } else {
        alert('Failed to save to GitHub.');
    }
}
