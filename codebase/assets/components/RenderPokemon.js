import React, {useEffect, useState} from 'react';

function RenderPokemon() {
    const [pokemonData, setPokemonData] = useState(null);
    const [pokemonDetails, setPokemonDetails] = useState(null);
    const [loading, setLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(() => {
        setLoading(true);
        fetch(`http://localhost:8080/api/getPokemons`)
            .then((response) => response.json())
            .then(setPokemonData)
            .then(() => setLoading(false))
            .catch(setError);
    }, []);

    if(loading) return <h1>Loading.......</h1>;
    if (error) return <pre>{JSON.stringify(error, null, 2)}</pre>;

    if (!pokemonData) {
        return <div>No Pokemon here...</div>;
    }

    // eslint-disable-next-line react/prop-types
    const listItems = pokemonData.map((el) =>
        // eslint-disable-next-line react/jsx-key
        <div >
            <p onClick={() => setPokemonDetails(el.details)}>{el.name}</p>
            <img onClick={() => setPokemonDetails(el.details)} src={el.img_url} />
        </div>
    );

    return <div>
        <div>{listItems}</div>
        <div>{pokemonDetails}</div>
    </div>;
}

export default RenderPokemon;
