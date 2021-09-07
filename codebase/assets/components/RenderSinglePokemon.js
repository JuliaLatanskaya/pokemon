import React, {useEffect, useState} from 'react';

function RenderSinglePokemon({ url, name }) {
    const [pokemonInfo, setPokemonInfo] = useState(null);
    const [pokemonShow, setPokemonShow] = useState(null);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(() => {
        setLoading(true);
        url = "http://localhost:8080/api/getSinglePokemon/?url=" + encodeURIComponent(url);

        fetch(url)
            .then((response) => response.json())
            .then(setPokemonInfo)
            .then(() => setLoading(false))
            .catch(setError);
    }, []);

    if(loading) return <div><img src="https://c.tenor.com/dnblbHyLgtMAAAAi/%D0%B7%D0%B0%D0%B3%D1%80%D1%83%D0%B7%D0%BA%D0%B0.gif" /></div>;
    if (error) return <pre>{JSON.stringify(error, null, 2)}</pre>;

    if (pokemonInfo) {
        return (<tr>
            <td onClick={() => setPokemonShow(pokemonInfo.details)}><p>{name}</p></td>
            <td onClick={() => setPokemonShow(pokemonInfo.details)}><img  src={pokemonInfo.logo}/></td>
            <td><div>{pokemonShow}</div></td>
        </tr>);
    }

    if (!pokemonInfo) {
        return <div>No Pokemon here...</div>;
    }

}

export default RenderSinglePokemon;
