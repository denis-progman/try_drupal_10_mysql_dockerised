function draw(field) {
    field.innerHTML = ''
    for (let n = 0; n < 9; n++) {
        field.innerHTML += `<div class="cells" data-cell_number="${n}"></div>`
    }
}

const field = document.getElementById('game')
let steps = 0

draw(field)

document.addEventListener('click', e => {
        const cell = e.target
        if (!cell.innerText) {
            steps ++
            cell.innerText = (steps % 2) ? 'X' : '0'
            
            fetch('/tic_tac_toe/move', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ cell_number: cell.dataset.cell_number })
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message)
                })
                .catch(error => {
                    alert("Unexpected error, sorry for the inconvenience.")
                });

        } else {
            if (steps >= 9) {
                draw(field)
                steps = 0
                alert('Game complete!')
            }
        }
    }
)