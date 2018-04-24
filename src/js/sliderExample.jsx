import React, { Component } from "react";
import Slider from "react-slick";

export default class SimpleSlider extends Component {
    render() {
        const settings = {
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1
        };
        return (
            <Slider {...settings}>
                <div className="title_slider" key={i}><Link to={'posts/' + post.slug}>{post.title.rendered}</Link></div>
            </Slider>
        );
    }
}
