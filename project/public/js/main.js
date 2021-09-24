const showForm = (e) => {
    const id = e.getAttribute('data-id')

    document.getElementById('popup').style.display = 'flex'
    document.getElementById('popupForm').action = `http://localhost/project/public/buy/${id}`
}

const closeForm = () => {
    document.getElementById('popup').style.display = 'none'
    document.getElementById('popupForm').action = ""
}