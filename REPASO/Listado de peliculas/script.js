const apiKey = 'cdf04697'; // Reemplaza con tu API key de OMDb
let currentPage = 1;
let searchTerm = '';

async function searchMovies() {
    searchTerm = document.getElementById('search').value;
    currentPage = 1;
    fetchMovies();
}

async function fetchMovies() {
    const response = await fetch(`https://www.omdbapi.com/?s=${searchTerm}&page=${currentPage}&apikey=${apiKey}`);
    const data = await response.json();

    if (data.Response === "True") {
        displayMovies(data.Search);
        updatePagination(data.totalResults);
    } else {
        document.getElementById('movie-list').innerHTML = `<p>No se encontraron resultados.</p>`;
        document.getElementById('pagination').style.display = 'none';
    }
}

function displayMovies(movies) {
    const movieList = document.getElementById('movie-list');
    movieList.innerHTML = '';

    movies.forEach(movie => {
        const movieItem = document.createElement('div');
        movieItem.classList.add('movie-item');

        movieItem.innerHTML = `
            <img src="${movie.Poster !== 'N/A' ? movie.Poster : 'placeholder.jpg'}" alt="${movie.Title}">
            <h3>${movie.Title}</h3>
            <p>Año: ${movie.Year}</p>
        `;

        movieList.appendChild(movieItem);
    });
}

function updatePagination(totalResults) {
    const totalPages = Math.ceil(totalResults / 10);
    document.getElementById('page-info').textContent = `Página ${currentPage} de ${totalPages}`;

    document.getElementById('prev').disabled = currentPage === 1;
    document.getElementById('next').disabled = currentPage === totalPages;

    document.getElementById('pagination').style.display = 'flex';
}

function changePage(direction) {
    currentPage += direction;
    fetchMovies();
}
