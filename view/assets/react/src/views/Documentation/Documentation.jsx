import React from "react";
// nodejs library that concatenates classes
import classNames from "classnames";
// react components for routing our app without refresh

// @material-ui/core components
import withStyles from "@material-ui/core/styles/withStyles";
// @material-ui/icons
// core components

import GridItem from "components/Grid/GridItem.jsx";

// sections for this page

import CarbonPHP from "./Sections/CarbonPHP";
import Dependencies from "./Sections/Dependencies";
import Environment from "./Sections/Environment.jsx";
import Installation from "./Sections/Installation.jsx";
import FileStructure from "./Sections/FileStructure.jsx";
import OptionsIndex from "./Sections/OptionsIndex.jsx";
import Bootstrap from "./Sections/Bootstrap.jsx";
import ControllerModel from "./Sections/ControllerModel.jsx";
import ParallelProcessing from "./Sections/ParallelProcessing.jsx";

// FileStructure OptionsIndex Bootstrap Wrapper ParallelProcessing
import componentsStyle from "assets/jss/material-kit-react/views/components.jsx";

import Navbar from "views/Documentation/Navbar";
import Parallax from "../../components/Parallax/Parallax";
import GridContainer from "../../components/Grid/GridContainer";
import Footer from "../../components/Footer/Footer";


import HeaderTop from "components/HeaderTop/HeaderTop";
import HeaderLinks from "components/HeaderTop/HeaderLinks.jsx";
// import Sections from "views/Documentation/Sections/Sections";


import DashboardIcon from "@material-ui/icons/Dashboard";
import Routing from "./Sections/Routing";
import Requests from "./Sections/Requests";
import DatabaseEntities from "./Sections/DatabaseEntities";
import Session from "./Sections/Session";
import Singleton from "./Sections/Singleton";
import Server from "./Sections/Server";
import View from "./Sections/View";
import BrowserOSSupport from "./Sections/BrowserOSSupport";
import Implementations from "./Sections/Implementations";
import Support from "./Sections/Support";
import License from "./Sections/License";
import Overview from "./Sections/Overview";


class Documentation extends React.Component {
    constructor() {
        super();
        this.state = {
            isLoaded: false
        }
    }

    componentDidMount() {
        this.setState({
            isLoaded: true
        });
    }

    render() {
        console.log("Documentation JSX RENDER");

        console.log(this.props);

        const {classes, ...rest} = this.props;

        let publicDocumentationRoutes = [
            {
                path: "/6.0/Documentation/CarbonPHP",     // I'm leaving this here for the time being as an example
                name: "Introduction",          // This should be loaded under a different wrapper
                icon: DashboardIcon,
                component: CarbonPHP
            },
            {
                path: "/6.0/Documentation/Dependencies",
                name: "Dependencies",
                icon: DashboardIcon,
                component: Dependencies
            },
            {
                path: "/6.0/Documentation/QuickStart",
                name: "Quick Start",
                icon: DashboardIcon,
                views: [
                    {
                        path: "/6.0/Documentation/Environment",
                        name: "Environment",
                        icon: DashboardIcon,
                        component: Environment
                    }, {
                        path: "/6.0/Documentation/Installation",
                        name: "Installation",
                        icon: DashboardIcon,
                        component: Installation
                    }, {
                        path: "/6.0/Documentation/FileStructure",
                        name: "Structure",
                        icon: DashboardIcon,
                        component: FileStructure
                    }, {
                        path: "/6.0/Documentation/OptionsIndex",
                        name: "Configuration",
                        icon: DashboardIcon,
                        component: OptionsIndex
                    }, {
                        path: "/6.0/Documentation/Bootstrap",
                        name: "Bootstrap",
                        icon: DashboardIcon,
                        component: Bootstrap
                    }, {
                        path: "/6.0/Documentation/ControllerModel",
                        name: "Controller -> Model",
                        icon: DashboardIcon,
                        component: ControllerModel
                    }, {
                        path: "/6.0/Documentation/PHPApplications/View",
                        name: "View",
                        icon: DashboardIcon,
                        component: View
                    }
                ]
            },
            {
                name: "PHP Applications",
                icon: DashboardIcon,
                views: [
                    {
                        path: "/6.0/Documentation/PHPApplications/Overview",
                        name: "Overview",
                        icon: DashboardIcon,
                        component: Overview
                    }, {
                        path: "/6.0/Documentation/PHPApplications/Route",
                        name: "Routing",
                        icon: DashboardIcon,
                        component: Routing
                    }, {
                        path: "/6.0/Documentation/PHPApplications/Requests",
                        name: "Requests",
                        icon: DashboardIcon,
                        component: Requests
                    }, {
                        path: "/6.0/Documentation/PHPApplications/DatabaseEntities",
                        name: "Database & Entities",
                        icon: DashboardIcon,
                        component: DatabaseEntities
                    }, {
                        path: "/6.0/Documentation/PHPApplications/Session",
                        name: "Session",
                        icon: DashboardIcon,
                        component: Session
                    }, {
                        path: "/6.0/Documentation/PHPApplications/Singleton",
                        name: "Singleton",
                        icon: DashboardIcon,
                        component: Singleton
                    }, {
                        path: "/6.0/Documentation/PHPApplications/Server",
                        name: "Server",
                        icon: DashboardIcon,
                        component: Server
                    }, {
                        path: "/6.0/Documentation/ParallelProcessing",
                        name: "Parallel Processing",
                        icon: DashboardIcon,
                        component: ParallelProcessing
                    },
                ]
            },
            {
                path: "/6.0/Documentation/BrowserOSSupport",
                name: "Changelog",
                icon: DashboardIcon,
                component: BrowserOSSupport
            },
            {
                path: "/6.0/Documentation/Implementations",
                name: "Implementations",
                icon: DashboardIcon,
                component: Implementations
            },
            {
                path: "/6.0/Documentation/Support",
                name: "Support",
                icon: DashboardIcon,
                component: Support
            },
            {
                path: "/6.0/Documentation/License",
                name: "License",
                icon: DashboardIcon,
                component: License
            },
            {
                redirect: true,
                path: "/5.0",
                pathTo: "/6.0/Documentation/CarbonPHP",
                name: "Examples"
            },
            {
                redirect: true,
                path: "/6.0/",
                pathTo: "/6.0/Documentation/CarbonPHP",
                name: "Examples"
            },
            {
                redirect: true,
                path: "/",
                pathTo: "/6.0/Documentation/CarbonPHP",
                name: "Examples"
            }
        ];


        // transparent here seems to work 50% the time, replace with dark if trouble persists
        return (
            <div>
                <HeaderTop
                    brand="CarbonPHP.com"
                    rightLinks={<HeaderLinks/>}
                    fixed
                    color="transparent"
                    changeColorOnScroll={{
                        height: 400,
                        color: "dark"
                    }}
                    {...rest}
                />
                <Parallax image={require("assets/img/Carbon-teal-180.png")}>
                    <div className={classes.container}>
                        <GridContainer>
                            <GridItem>
                                <div className={classes.brand}>
                                    <h1 className={classes.title}>CarbonPHP [C6]</h1>
                                    <h3 className={classes.subtitle}>
                                        Build full scale applications.
                                    </h3>
                                </div>
                            </GridItem>
                        </GridContainer>
                    </div>
                </Parallax>
                <div>
                    <div>
                        <Navbar className={classNames(classes.main, classes.mainRaised)}
                                routes={publicDocumentationRoutes}/>
                        <div className={classNames(classes.main, classes.mainRaised)}>
                            {this.props.subRoutingSwitch(publicDocumentationRoutes, rest)}
                        </div>
                    </div>
                </div>
                <Footer fluid/>
            </div>
        );
    }
}

export default withStyles(componentsStyle)(Documentation);