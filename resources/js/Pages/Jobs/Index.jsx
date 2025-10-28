import React from 'react';
import Layout from '../../components/Layout';
import Link from '../../components/Link';
import EmailFilter from '../../components/EmailFilter';

const Index = ({ jobs, email }) => (
  <Layout title="View all jobs">
    <EmailFilter email={email} />
    <div className="flex flex-col w-2/3 mt-4 border">
      <div className="grid grid-cols-[20%_20%_15%_40%_5%] font-bold py-2 border-b">
        <div className="px-2">
          Contact
        </div>
        <div className="pr-2">
          Email
        </div>
        <div className="pr-2">
          Job Location
        </div>
        <div className="pr-2">
          Job Details
        </div>
        <div className="pr-2">
          {' '}
        </div>
      </div>
      {jobs.map(({ id, contact_name, contact_phone, contact_email, location, details }) => (
        <div
          className="grid grid-cols-[20%_20%_15%_40%_5%] py-2"
          key={id}
        >
          <div className="px-2">
            {contact_name} ({contact_phone})
          </div>
          <div className="pr-2">
            {contact_email}
          </div>
          <div className="pr-2">
            {location}
          </div>
          <div className="pr-2">
            {details}
          </div>
          <div className="pr-2">
            <Link href={`/jobs/${id}`}>
              Edit
            </Link>
          </div>
        </div>
      ))}
    </div>
  </Layout>
);

export default Index;
