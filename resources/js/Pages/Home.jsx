import React from 'react';
import Layout from '../components/Layout';
import Link from '../components/Link';

const Home = () => (
  <Layout title="Post-a-Job">
    <div className="mb-4">
      <p>Welcome to Post-a-Job!</p>
    </div>
    <ul>
      <li>
        You can...{' '}
        <Link href="/jobs/create">
          Post a new job
        </Link>
      </li>
      <li>
        Or you can...{' '}
        <Link href="/jobs">
          View all jobs
        </Link>
      </li>
    </ul>
  </Layout>
);

export default Home;
