import React from 'react';
import { render } from 'react-dom';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';

var jQuery = require('jquery');
// Load the Sass file
require('../scss/style.scss');
import 'bootstrap/dist/css/bootstrap.css';
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';
// Include Custom Script
require('./custom/main.js');

import Header from './header';
import Footer from './footer';
import Posts from './posts';
import Post from './post';
import Products from './products';
import Product from './product';
import NotFound from './not-found';

import LoadingIcon from './loading-icon.gif';
import Placeholder from './placeholder.jpg';


const App = () => (
    <div id="page-inner">
        <Header />
        <div id="content">
            <Switch>
                <Route exact path={ReactMaxSettings.path} component={Posts} />
                <Route exact path={ReactMaxSettings.path + 'posts/:slug'} component={Post} />
                <Route exact path={ReactMaxSettings.path + 'products'} component={Products} />
                <Route exact path={ReactMaxSettings.path + 'products/:product'} component={Product} />
                <Route path="*" component={NotFound} />
            </Switch>
        </div>
        <Footer />
    </div>
);
// Routes
const routes = (
    <Router>
        <Route path="/" component={App} />
    </Router>
);

render(
    (routes), document.getElementById('page')
);