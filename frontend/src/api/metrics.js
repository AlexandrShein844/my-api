const API_URL = import.meta.env.VITE_API_URL;


export async function getMetrics(){

    const response = await fetch(
        `${API_URL}/metrics`
    )


    if(!response.ok){
        throw new Error(
            'Failed to load metrics'
        )
    }


    return await response.json()

}