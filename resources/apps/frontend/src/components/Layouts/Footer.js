import React, {Component} from 'react';

class Footer extends Component {
  state = {};

  render() {
    return (
      <footer className="sticky-footer">
        <div className="container my-auto">
          <div className="copyright text-center my-auto">
            <span>
              Copyright &copy; {process.env.REACT_APP_APP_NAME || 'Laragym'}{' '}
              2023
            </span>
          </div>
        </div>
      </footer>
    );
  }
}

export default Footer;
