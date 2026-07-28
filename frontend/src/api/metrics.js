const API_URL = 'http://my-api.local/api/v1'


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