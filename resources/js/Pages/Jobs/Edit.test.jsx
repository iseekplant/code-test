import { render } from '@testing-library/react';
import Edit from './Edit';
import userEvent from '@testing-library/user-event';
import { router } from '@inertiajs/react';

vi.mock('@inertiajs/react', () => ({
  router: {
    put: vi.fn(),
  },
  Link: ({ children, ...props }) => <a {...props}>{children}</a>,
}));

describe('Jobs/Edit', () => {
  it('renders the details of the job', () => {
    const { getByLabelText } = render(<Edit job={job} />);

    expect(getByLabelText('Your name')).toHaveValue(job.contact_name);
    expect(getByLabelText('Your phone number')).toHaveValue(job.contact_phone);
    expect(getByLabelText('Your email')).toHaveValue(job.contact_email);
    expect(getByLabelText('Where will the job be?')).toHaveValue(job.location);
    expect(getByLabelText('What are the job details?')).toHaveValue(job.details);
  });

  it('updates the job when the form is submitted', async () => {
    const { getByLabelText, getByText } = render(<Edit job={job} />);

    const user = userEvent.setup();

    await user.clear(getByLabelText('Your name'));
    await user.type(getByLabelText('Your name'), 'Todd');

    await user.clear(getByLabelText('Your phone number'));
    await user.type(getByLabelText('Your phone number'), '0400000002');

    await user.clear(getByLabelText('Your email'));
    await user.type(getByLabelText('Your email'), 'new@user.com.au');

    await user.clear(getByLabelText('Where will the job be?'));
    await user.type(getByLabelText('Where will the job be?'), 'Sydney');

    await user.clear(getByLabelText('What are the job details?'));
    await user.type(getByLabelText('What are the job details?'), 'I want to fill a hole.');

    await user.click(getByText('Update'));

    expect(router.put).toHaveBeenCalledWith('/jobs/1', {
      contact_name: 'Todd',
      contact_phone: '0400000002',
      contact_email: 'new@user.com.au',
      location: 'Sydney',
      details: 'I want to fill a hole.',
    });
  });
});

const job = {
  id: 1,
  contact_name: 'Rod',
  contact_phone: '0400000001',
  contact_email: 'test@user.com.au',
  location: 'Brisbane',
  details: 'I want to dig a hole.',
};
