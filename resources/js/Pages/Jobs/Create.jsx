import React from 'react';
import Layout from '../../components/Layout';
import { router } from '@inertiajs/react';
import JobForm from '../../components/JobForm';

const Create = ({ errors }) => {
  const storeJob = (data) => {
    router.post('/jobs', data);
  };

  return (
    <Layout title="Post a Job">
      <JobForm onSubmit={storeJob} />
    </Layout>
  );
};

export default Create;
