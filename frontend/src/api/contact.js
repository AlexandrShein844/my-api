const API_URL = import.meta.env.VITE_API_URL;

export async function sendContact(data) {
    const response = await fetch(`${API_URL}/contact`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify(data),
    });

    const result = await response.json();

    if (!response.ok) {
        throw result;
    }

    return result;
}