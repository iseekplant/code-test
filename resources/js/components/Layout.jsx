import React from 'react';
import Link from './Link';
import { Link as InertiaLink } from '@inertiajs/react';

const Layout = ({ title, children }) => (
  <>
    <div className="bg-emerald-50 py-2 pl-6">
      <ul className="flex items-center space-x-4">
        <li className="text-lg w-40 font-bold">
          <InertiaLink href="/">
            Post-a-Job
          </InertiaLink>
        </li>
        <li>
          <Link href="/jobs/create">
            Post a Job
          </Link>
        </li>
        <li>
          <Link href="/jobs">
            View All
          </Link>
        </li>
      </ul>
    </div>
    <div className="p-6">
      <h1 className="text-3xl font-bold mb-4">
        {title}
      </h1>
      {children}
    </div>
  </>
);

export default Layout;
