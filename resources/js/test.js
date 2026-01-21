const assignUserBtn = document.getElementById('submit');
const variable = document.getElementById("var").value();

assignUserBtn.addEventListener('click', async () => {
    try {
        const response = await axios.post(`/test/${variable}`, { variable: variable });
        console.log(response.data);
    } catch (error) {
        console.error(error);
    }
});
