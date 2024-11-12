async function deactivate_account()
{
    event.preventDefault();
    try {
        const response = await fetch("http://localhost/NewRaccoonXpress/api/usersAPI.php?action=deactivate", {
            method: "POST"
        });
        const result = await response.json();
        if (result.deactivated) {
            // Redirige al usuario a la página de inicio o de login
            window.location.href = "landing_page.php";
            localStorage.removeItem('user_id');
            localStorage.removeItem('user_role');
            return true;
        } else {
            console.error("Error al eliminar la cuenta:", response.statusText);
            return false;
        }
    }
    catch (error) {
        console.error("Error:", error);
        return false;
    }
}
