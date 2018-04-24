// External dependencies
import React from 'react';
import { Link } from 'react-router-dom';
import Placeholder from './placeholder.jpg';
import NotFound from './not-found';
import Slider from "react-slick";
import SimpleSlider from './sliderExample';


class PostList extends React.Component {

    renderPosts() {

        return this.props.posts.map((post, i) => {
            const settings = {
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1
            };
            return (
                <div className="col-md-4 card-outer" key={i}>
                    <div className="card">
                        <div className="img-outer">
                            <Link to={'posts/' + post.slug}>
                                <img className="card-img-top" src={post.featured_image_src ? post.featured_image_src : Placeholder} alt="Featured Image" />
                            </Link>
                        </div>
                        <div className="card-body">
                            <h4 className="card-title"><Link to={'posts/' + post.slug}>{post.title.rendered}</Link></h4>
                            <p className="card-text"><small className="text-muted">{post.author_name} &ndash; {post.published_date}</small></p>
                            <p>{jQuery(post.excerpt.rendered).text()}</p>
                        </div>
                        <Slider {...settings}>{this.props.posts.map((post, i) => {
                            return (
                                <div key={i}> <Link to={'posts/' + post.slug}>{post.title.rendered}</Link></div>
                            )
                        })}
                        </Slider>

                    </div>
                </div>
            )
        });
    }

    renderEmpty() {
        return (
            <NotFound />
        )
    }

    render() {
        if (!this.props.posts) {
            return null;
        }

        return (
            <div className="posts-container">
                {this.props.posts.length ?
                    this.renderPosts() :
                    this.renderEmpty()
                }
            </div>
        );
    }
}


export default PostList;