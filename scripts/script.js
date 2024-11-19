function toggleFavorite(artId) {
    fetch('add_to_favorites.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ art_id: artId })
    })
    .then(response => response.json())
    .then(data => {
        const favoriteButton = document.querySelector(`#favorite-btn-${artId}`);
        if (data.status === 'added') {
            favoriteButton.textContent = 'Usuń z ulubionych';
        } else if (data.status === 'removed') {
            favoriteButton.textContent = 'Dodaj do ulubionych';
        } else {
            alert('Wystąpił problem: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Błąd:', error);
    });
}
