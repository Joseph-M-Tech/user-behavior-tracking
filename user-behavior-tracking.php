<?php
/*
Plugin Name: User Behavior Tracking
Description: Tracks user behavior on the website and renders data in admin UI.
Version: 1.0
Author: Joseph
Author URI: https://seloku.com
*/

// Plugin code goes here


// Enqueue JavaScript file
function enqueue_user_behavior_tracking_scripts() {
    wp_enqueue_script(
      'user-behavior-tracking-script',
      plugin_dir_url(__FILE__) . 'user-behavior-tracking.js',
      array('jquery'),
      '1.0',
      true
    );
    wp_enqueue_script(
        'react',
        'https://unpkg.com/react@16.13.1/umd/react.production.min.js',
        array(),
        '16.13.1',
        true
      );
    
      wp_enqueue_script(
        'react-dom',
        'https://unpkg.com/react-dom@16.13.1/umd/react-dom.production.min.js',
        array('react'),
        '16.13.1',
        true
      );
    
      wp_enqueue_script(
        'recharts',
        'https://unpkg.com/recharts@2.1.0/umd/recharts.min.js',
        array('react', 'react-dom'),
        '2.1.0',
        true
      );
    }
// add_action('wp_enqueue_scripts', 'enqueue_user_behavior_tracking_scripts');


add_action('wp_enqueue_scripts', 'enqueue_user_behavior_tracking_scripts');
  
  // Enqueue CSS file
function enqueue_user_behavior_tracking_styles() {
    wp_enqueue_style(
      'user-behavior-tracking-style',
      plugin_dir_url(__FILE__) . 'user-behavior-tracking.css',
      array(),
      '1.0',
      'all'
    );
  }
add_action('wp_enqueue_scripts', 'enqueue_user_behavior_tracking_styles');




// Create admin UI menu page
function user_behavior_tracking_menu() {
    add_menu_page(
      'User Behavior Tracking',
      'Behavior Tracking',
      'manage_options',
      'user-behavior-tracking',
      'user_behavior_tracking_page',
      'dashicons-chart-area',
      75
    );
  }
  add_action('admin_menu', 'user_behavior_tracking_menu');
  
// Render admin UI menu page
function user_behavior_tracking_page() {
  // Retrieve and process tracked user behavior data

  // Render the data using HTML, CSS, and Recharts
  ?>
  <div class="wrap">
    <h1>Users Behavior Tracking</h1>
    <div id="chart-container"></div>
  </div>

  <script>
  // Use React and Recharts to render charts in the "chart-container" element
  const { useEffect, useState } = React;
  const { LineChart, Line, XAxis, YAxis, CartesianGrid, Tooltip, Legend } = Recharts;

  const ChartComponent = () => {
    // Fetch and process user behavior data
    const [data, setData] = useState([]);

    useEffect(() => {
      // Fetch user behavior data from the server and process it
      const fetchData = async () => {
        // Replace this with your code to fetch and process the user behavior data
        const response = await fetch('https://api.coincap.io/v2/assets/?limit=20');
        const json = await response.json();
        // Process the data as per your requirements
        setData(json);
      };

      fetchData();
    }, []);

    return (
      <LineChart width={800} height={400} data={data}>
        <XAxis dataKey="date" />
        <YAxis />
        <CartesianGrid stroke="#f5f5f5" />
        <Tooltip />
        <Legend />
        <Line type="monotone" dataKey="scrollRate" stroke="#8884d8" />
        <Line type="monotone" dataKey="engagementTime" stroke="#82ca9d" />
        <Line type="monotone" dataKey="clickThroughRate" stroke="#ffc658" />
        <Line type="monotone" dataKey="pagesVisited" stroke="#e84a5f" />
      </LineChart>
    );
  };

  ReactDOM.render(<ChartComponent />, document.getElementById('chart-container'));
</script>

  <?php
}
  

  