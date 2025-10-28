import Layout from '../../components/Layout';
import React from 'react';
import { router } from '@inertiajs/react';
import JobForm from '../../components/JobForm';

const Edit = ({ job, errors }) => {
  const updateJob = (data) => {
    router.put(`/jobs/${job.id}`, data);
  };

  return (
    <Layout title="Edit Job">
      <JobForm
        job={job}
        onSubmit={updateJob}
      />
    </Layout>
  );
}

export default Edit;
