function draw(field) {
    field.innerHTML = ''
    for (let n = 0; n < 9; n++) {
        field.innerHTML += '<div class="cells"></div>'
    }
}

const field = document.getElementById('game')
let steps = 0
let cell


draw(field)

document.addEventListener('click', e => {
        const cell = e.target
        if (!cell.innerText) {
            steps ++
            cell.innerText = (steps % 2) ? 'X' : '0'
        } else {
            if (steps >= 9) {
                draw(field)
                steps = 0
                alert('Game complete!')
            }
        }
    }
)