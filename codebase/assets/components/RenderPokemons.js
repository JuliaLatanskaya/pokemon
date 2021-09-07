import React, {useEffect, useState } from 'react';
import RenderSinglePokemon from './RenderSinglePokemon';

function RenderPokemons() {
    const [pokemonData, setPokemonData] = useState(null);
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
        <RenderSinglePokemon url={el.url} name={el.name} />
    );

    return <div>
        <h1>Pockemon Team</h1>
        <table className="table table-bordered table-striped table-hover">{listItems}</table>
    </div>;
}

export default RenderPokemons;
