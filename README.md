# 3D visualization of real-time earthquake data

This project creates a 3d visualization of real-​time earthquake data gathered from the U.S. Geological Survey website. The real-​time data can be downloaded as CSV formatted data files from [USGS website](https://earthquake.usgs.gov/earthquakes/feed/v1.0/csv.php).
A PHP file <tt>/static/js/quake/earthmap.php</tt> is used to download the earthquake data and to create a texture map from a template texture image file of the Earth’s surface. 
Opening <tt>/static/js/quake/quake-so.html</tt> shows a spinning globe using the created texture map with the 3D Javascript library Three.js. The globe can be manipulated by dragging with mouse or the finger when using a touch screen.

## Installation

The files in this project can be copied directly to the root of a web server. 
The file <tt>/static/js/quake/quake-so.html</tt> shows a standalone full sized representation of the data.
The file <tt>/static/js/quake/quake.html</tt> can be included in another web page as shown under [d3v.one/3d-earthquake-data/](https://d3v.one/3d-earthquake-data/).

## Built With

[Three.js](https://threejs.org/) - 3D Javascript Library

## Author

**Michael Koch** [d3v.one](https://d3v.one)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details


