import React, { useState } from "react";

function App() {
	const [details, setDetails] = useState(null);
	const [detailsLocal, setDetailsLocal] = useState(null);
	
    const getUserGeolocationDetails = () => {
        fetch(
            "https://geolocation-db.com/json/0f761a30-fe14-11e9-b59f-e53803842572"
        )
            .then(response => response.json())
            .then(data => setDetails(data));
    };
	
    const getLocalUserGeolocationDetails = () => {
        fetch(
			"https://www.dia-dema.it/react/api/saveClientIp.php"
            //"http://localhost/react-get-ip/api/saveClientIp.php"
        )
            .then(response => response.json())
            .then(data => setDetailsLocal(data));
    };
			
	return (
		<React.Fragment>
			<div className="container">
				<div className="App">
					
					{details && (
						<p>
							Location :{" "}
							{`${details.city}, ${details.country_name}(${details.country_code})`}
							<br />
							IP: {details.IPv4}
						</p>
					)}
					
					{detailsLocal && (
						<p>
							IP: {detailsLocal.IPv4}
							<br />
							Headers: {detailsLocal.headers}
						</p>
					)}
					
				</div>

				<button className="btn btn-primary" onClick={getUserGeolocationDetails}>
					Find my details (from geolocation-db.com)
				</button>
				<button className="btn btn-primary ml-3" onClick={getLocalUserGeolocationDetails}>
					Find my details (from local php API)
				</button>				
							
			</div>
		</React.Fragment>
	);
}

export default App;
