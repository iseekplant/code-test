import { render } from '@testing-library/react';
import Index from './Index';
import userEvent from '@testing-library/user-event';
import { router } from '@inertiajs/react';

vi.mock('@inertiajs/react', () => ({
  router: {
    replace: vi.fn(),
  },
  Link: ({ children, ...props }) => <a {...props}>{children}</a>,
}));

describe('Jobs/Index', () => {
  it('displays the details of each job', () => {
    const jobs = [
      {
        id: 1,
        contact_name: 'Rod',
        contact_phone: '0400000001',
        contact_email: 'rod@email.com.au',
        location: 'Brisbane',
        details: 'I want to dig a hole.',
      },
      {
        id: 2,
        contact_name: 'Reilly',
        contact_phone: '0400000002',
        contact_email: 'reilly@email.com.au',
        location: 'Cairns',
        details: 'I want to build a shed.',
      },
    ];

    const { getByText, getAllByText } = render(
      <Index
        jobs={jobs}
      />
    );

    jobs.forEach((job) => {
      expect(getByText(new RegExp(job.contact_name))).toBeInTheDocument();
      expect(getByText(new RegExp(job.contact_phone))).toBeInTheDocument();
      expect(getByText(new RegExp(job.contact_email))).toBeInTheDocument();
      expect(getByText(job.location)).toBeInTheDocument();
      expect(getByText(job.details)).toBeInTheDocument();
    });

    const [linkOne, linkTwo] = getAllByText('Edit');

    expect(linkOne).toHaveAttribute('href', '/jobs/1');
    expect(linkTwo).toHaveAttribute('href', '/jobs/2');
  });

  it('refreshes the page when the email search changes', async () => {
    const { getByLabelText } = render(
      <Index
        jobs={[]}
      />
    );

    const user = userEvent.setup();

    await user.type(getByLabelText('Filter by email'), 'a');

    expect(router.replace).toHaveBeenCalledWith('/jobs?email=a');
  });

  it('presets the email filter value', () => {
    const { getByLabelText } = render(
      <Index
        jobs={[]}
        email="abc"
      />
    );

    expect(getByLabelText('Filter by email')).toHaveValue('abc');
  });
});
