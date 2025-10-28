import React from 'react';
import { Link as InertiaLink } from '@inertiajs/react';

const Link = ({ children, ...props }) => (
  <InertiaLink {...props} className="text-cyan-700 underline">
    {children}
  </InertiaLink>
);

export default Link;
