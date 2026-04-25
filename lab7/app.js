const API_KEY = 'WTnEIkvSH9f8TuIS6cN8lMjykTDByqk3OWEMsSB-4l4';
const API_BASE_URL = 'https://api.unsplash.com';

// DOM Elements
const searchInput = document.getElementById('searchInput');
const searchBtn = document.getElementById('searchBtn');
const gallery = document.getElementById('gallery');
const loadingDiv = document.getElementById('loading');
const errorDiv = document.getElementById('error');
const methodBtns = document.querySelectorAll('.method-btn');

let currentMethod = 'xhr';

// Event Listeners
searchBtn.addEventListener('click', performSearch);
searchInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') performSearch();
});

methodBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        methodBtns.forEach(b => b.classList.remove('active'));
        e.target.classList.add('active');
        currentMethod = e.target.dataset.method;
    });
});

// Main Search Function
function performSearch() {
    const query = searchInput.value.trim();
    if (!query) {
        showError('Please enter a search term');
        return;
    }

    if (API_KEY === 'YOUR_UNSPLASH_ACCESS_KEY') {
        showError('⚠️ Please set your Unsplash API Key in the app.js file');
        return;
    }

    clearGallery();
    showLoading();

    switch(currentMethod) {
        case 'xhr':
            searchWithXHR(query);
            break;
        case 'promise':
            searchWithPromise(query);
            break;
        case 'async':
            searchWithAsync(query);
            break;
    }
}

// ============================================
// METHOD 1: XMLHTTPRequest
// ============================================
function searchWithXHR(query) {
    const xhr = new XMLHttpRequest();
    const url = `${API_BASE_URL}/search/photos?query=${encodeURIComponent(query)}&per_page=20&client_id=${API_KEY}`;

    xhr.open('GET', url, true);
    
    xhr.onload = function() {
        hideLoading();
        if (xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            displayResults(data.results, 'XMLHTTPRequest');
        } else {
            showError(`Error: ${xhr.status} ${xhr.statusText}`);
        }
    };

    xhr.onerror = function() {
        hideLoading();
        showError('XHR Request failed');
    };

    xhr.send();
}

// ============================================
// METHOD 2: Fetch with Promises
// ============================================
function searchWithPromise(query) {
    const url = `${API_BASE_URL}/search/photos?query=${encodeURIComponent(query)}&per_page=20&client_id=${API_KEY}`;

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            hideLoading();
            displayResults(data.results, 'Fetch + Promise');
        })
        .catch(error => {
            hideLoading();
            showError(`Error: ${error.message}`);
        });
}

// ============================================
// METHOD 3: Fetch with Async/Await
// ============================================
async function searchWithAsync(query) {
    try {
        const url = `${API_BASE_URL}/search/photos?query=${encodeURIComponent(query)}&per_page=20&client_id=${API_KEY}`;
        
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        const data = await response.json();
        hideLoading();
        displayResults(data.results, 'Fetch + Async/Await');
    } catch (error) {
        hideLoading();
        showError(`Error: ${error.message}`);
    }
}

// ============================================
// Display Results
// ============================================
function displayResults(results, method) {
    if (results.length === 0) {
        showEmptyState('No images found. Try a different search term.');
        return;
    }

    results.forEach(image => {
        const card = createImageCard(image, method);
        gallery.appendChild(card);
    });
}

function createImageCard(image, method) {
    const card = document.createElement('div');
    card.className = 'image-card';
    
    const author = image.user.name;
    const description = image.description || image.alt_description || 'No description';
    const imageUrl = image.urls.regular;
    const unsplashUrl = image.links.html;

    card.innerHTML = `
        <img src="${imageUrl}" alt="${description}" loading="lazy">
        <div class="image-info">
            <div class="method-badge">${method}</div>
            <div class="image-author">By: ${author}</div>
            <div class="image-description">${description}</div>
            <a href="${unsplashUrl}" target="_blank" class="image-link">View on Unsplash →</a>
        </div>
    `;

    // Click to open on Unsplash
    card.addEventListener('click', () => {
        window.open(unsplashUrl, '_blank');
    });

    return card;
}

// ============================================
// UI Helpers
// ============================================
function showLoading() {
    loadingDiv.style.display = 'flex';
    gallery.style.display = 'none';
    errorDiv.style.display = 'none';
}

function hideLoading() {
    loadingDiv.style.display = 'none';
    gallery.style.display = 'grid';
}

function showError(message) {
    errorDiv.textContent = message;
    errorDiv.style.display = 'block';
    gallery.style.display = 'none';
    loadingDiv.style.display = 'none';
}

function clearGallery() {
    gallery.innerHTML = '';
}

function showEmptyState(message) {
    const emptyState = document.createElement('div');
    emptyState.className = 'empty-state';
    emptyState.innerHTML = `
        <h2>😕</h2>
        <p>${message}</p>
    `;
    gallery.appendChild(emptyState);
}

// ============================================
// Initialize
// ============================================
window.addEventListener('load', () => {
    console.log('Lab 7: Unsplash Image Search Ready');
    console.log('Current Method:', currentMethod);
});
